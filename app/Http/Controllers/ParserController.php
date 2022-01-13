<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Network;
use App\Models\Season;
use App\Models\Serie;
use App\Models\Trailer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParserController extends Controller
{
    public function index($id) {
        try {


            $html = file_get_contents('https://www.toramp.com/schedule.php?id=' . $id);

            $countSeri = 0;
            $countSeasons = 0;



            $pattern['title'] = '#<header.*?class="pagehead".*?<h1.*?>(.*?)<span.*?</h1>.*?<div.*?class="fw_normal.*?">(.*?)</div>#si';
            $pattern['li'] = '#section.*?class="series_details.*?<ul.*?>(.*?)</ul>.*?</section>#si';
            $pattern['poster'] = '#<img[^>]* src=\"([^\"]*)\"[^>]*>#si';
            $pattern['status'] = '#title mr_5">.*?Статус.*?</span>.*?<span.*?val.*?">(.*?)</span>#si';
            $pattern['anime_type'] = '#<span.*?anime_type.*?>(.*?)</span>#si';

            preg_match_all($pattern['title'], $html, $match, PREG_SET_ORDER);
            preg_match_all($pattern['li'], $html, $match_li, PREG_SET_ORDER);
            preg_match_all($pattern['status'], $match_li[0][1], $match_status, PREG_SET_ORDER);
            preg_match_all($pattern['poster'], $match_li[0][0], $match_poster, PREG_SET_ORDER);
            preg_match_all($pattern['anime_type'], $html, $match_anime, PREG_SET_ORDER);


            $arMovie = [];
            $arMovie['name'] = $match[0][1] ?? '';
            $arMovie['name_original'] = $match[0][2] ?? '';
            $arMovie['slug'] = Str::slug($match[0][1] ?? '', '-') . '-' . Carbon::now()->format('dmyhis');
            if(isset($match_anime[0][1]) && $match_anime[0][1] == 'аниме'){
                $arMovie['category_id'] = '2';
            } else {
                $arMovie['category_id'] = '1';
            }
            $arMovie['author_id'] = '1';
            $arMovie['source_url'] = json_encode(['toramp_id' => $id]);
            $arMovie['status_movie'] = remove_emoji($match_status[0][1]) ?? '';


            // poster

            //default_poster.png

            //
            // https://images.unsplash.com/photo-1638280987803-f533dba99cab?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80

            $poster_url = $match_poster[0][1] ?? '';



            $movie = Movie::where('name', $arMovie['name'])->where('name_original', $arMovie['name_original'])->first();

            if($movie === null) {
                if (strpos($poster_url, 'default_poster') === false) {
                    $arMovie['picture'] = remote_upload_file($poster_url);
                }
                $movie_id = Movie::create($arMovie);
            } else {
                $movie_id = $movie;
            }

                //$movie_id->id

                if ($movie_id->id) {


                    $pattern['series_wrap'] = '#table.*?series_eps_table.*?</table>#si';
                    preg_match_all($pattern['series_wrap'], $html, $match_series, PREG_SET_ORDER);
                    foreach ($match_series as $serie) {
                        $ser = $serie[0];

                        $num = 0;
                        $pat = '#a.*?href="\#episode_(.*?)\.(.*?)".*?fill_space.*?class=".*?ft">(.*?)</div>.*?class="c_g2.*?>(.*?)</div>.*?datetime="(.*?)"#si';
                        preg_match_all($pat, $ser, $s, PREG_SET_ORDER);

                        foreach ($s as $num_ser) {
                            $number_season = $num_ser[1];
                            $arSer[$number_season][$num]['season'] = $number_season;
                            $arSer[$number_season][$num]['number'] = $num_ser[2];
                            $arSer[$number_season][$num]['name'] = html_entity_decode($num_ser[3]);
                            $arSer[$number_season][$num]['or_name'] = $num_ser[4];
                            $arSer[$number_season][$num]['realease_date'] = $num_ser[5];
                            $num++;
                        }
                        unset($ser);
                        unset($num);
                    }


                    foreach ($arSer as $k => $arSerie) {

                        $addSeason = [
                            'movie_id' => $movie_id->id,
                            'number' => $k,
                            'name' => $k . ' Сезон'
                        ];

                        $season = Season::where('movie_id', $addSeason['movie_id'])->where('number', $addSeason['number'])->where('name', $addSeason['name'])->first();

                        if ($season === null){
                            $id_season = Season::create($addSeason);
                            $countSeasons++;
                        } else {
                            $id_season = $season;
                        }

                        foreach ($arSerie as $serie) {

                            $addSeria = [
                                'season_id' => $id_season->id,
                                'number' => $serie['number'],
                                'name' => $serie['number'] . ' Серия',
                                'or_name' => $serie['or_name'],
                                'realease_date' => $serie['realease_date'],
                            ];

                            if(Serie::where('season_id', $id_season->id)->where('number', $serie['number'])->doesntExist()) {
                                $seria_id = Serie::create($addSeria);
                                $countSeri++;
                            }

                        }

                    }


                }





            $response = [
                'status' => 'ok',
                'message' => $id . ' ' . $arMovie['name'] . ' сезонов: ' .  $countSeasons . ' серий: ' . $countSeri
            ];

            return response()->json($response);

        } catch (\Exception $e) {

            $response = [
                'status' => 'not',
                'message' => 'такой страницы нет ' . $id,
                'error' => $e->getMessage(),
                'id_page' => $id
            ];

            return response()->json($response);
        }


    }


    public function auto_parse() {
        return view('page.parse');
    }



    public function tmdb_searchSerial ($name) {

        $data = [
            'query' => $name,
            'language' => 'ru'
        ];

        $configuration = getConfigTmdb();

        $res = apiCurlTmdb('search/tv', 'get', $data);

        if($res->results) {
            $response = [
                'status' => 'ok',
                'serials' => $res->results,
                'conf' => $configuration
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Ничего не найдено'
            ];
        }

        return response()->json($response);

    }


    // Обновление сериала, с админки
    public function setTmdbSource($id) {

        $data = request()->all();

        $idTMDB = $data['idTMDB'];

        $movie = Movie::where('id', $id)->first();


        if($movie !== null) {


            if ($movie->source_url) {
                $source = $movie->source_url;
            }

            $source['tmdb_id'] = $idTMDB;
            $movie->source_url = $source;

            $par = [
                'append_to_response' => 'keywords,videos',
                'language' => 'ru'
            ];

            $res = apiCurlTmdb('tv/' . $idTMDB, 'get', $par);


            $movie->name_original = $res->original_name;
            $movie->duration = $res->episode_run_time;
            $movie->tagline = $res->tagline;
            $movie->language = $res->original_language;
            $movie->homepage = $res->homepage;
            $movie->description = $res->overview;

            $first_air_date = Carbon::createFromFormat('Y-m-d', $res->first_air_date);
            $year = $first_air_date->format('Y');
            $movie->year = $year;


            if(strlen($res->poster_path) > 2) {
                if (!$movie->picture) {
                    $config = getConfigTmdb();
                    $poster_url = $config->images['secure_base_url'] . $config->images['poster_sizes'][3] . $res->poster_path;

                    //$movie->picture = remote_upload_file($poster_url);
                    $movie->picture = $poster_url;
                }
            }



            if(strlen($res->backdrop_path) > 2) {
                if (!$movie->screen_url) {

                    if (!isset($config)) {
                        $config = getConfigTmdb();
                    }

                    $screen_url = $config->images['secure_base_url'] . 'original' . $res->backdrop_path;

                    //$movie->screen_url = remote_upload_file($screen_url, 'app/public/backdrop/serial');
                    $movie->screen_url = $screen_url;

                }
            }


            $movie->save();


            // Каналы
            if(count($res->networks) > 0) {
                $network_ids = [];
                foreach($res->networks as $network){
                    if($network_up = Network::where('name', $network['name'])->first()){
                        $network_ids[] = $network_up->id;
                    } else {

                        if (!isset($config)) {
                            $config = getConfigTmdb();
                        }


                        $networkInput = [
                            'name' => $network['name'],
                            'slug' => Str::slug($network['name'], '-')
                        ];
                        if(isset($network['logo_path'])) {
                            $logo_url = $config->images['secure_base_url'] . 'original' . $network['logo_path'];
                            $networkInput['picture'] = $logo_url;
                        }

                        $newNetwork = Network::create($networkInput);
                        $network_ids[] = $newNetwork->id;
                    }
                }

                if(count($network_ids) > 0) {
                    $movie->networks()->sync($network_ids);
                }
            }

            // Жанры
            if(count($res->genres) > 0) {
                $genre_ids = [];
                foreach($res->genres as $genre){
                    if($genre_up = Genre::where('name', $genre['name'])->first()){
                        $genre_ids[] = $genre_up->id;
                    } else {
                        $newGenre = Genre::create([
                            'name' => $genre['name'],
                            'slug' => Str::slug($genre['name'], '-')
                        ]);
                        $genre_ids[] = $newGenre->id;
                    }
                }

                if(count($genre_ids) > 0) {
                    $movie->genres()->sync($genre_ids);
                }
            }

            // Страны
            if(count($res->origin_country) > 0) {
                $country_ids = [];
                foreach($res->origin_country as $country){
                    if($country_up = Country::where('name_eng', $country)->first()){
                        $country_ids[] = $country_up->id;
                    } else {
                        $newCountry = Country::create([
                            'name_eng' => $country,
                            'slug' => Str::slug($country, '-')
                        ]);
                        $country_ids[] = $newCountry->id;
                    }
                }

                if(count($country_ids) > 0) {
                    $movie->countries()->sync($country_ids);
                }
            }


            // Трейлеры
            if(isset($res->videos["results"]) && count($res->videos["results"]) > 0) {

                foreach($res->videos["results"] as $video){

                    if($video['site'] == 'YouTube') {

                        if(Trailer::where('key', $video['key'])->where('movie_id', $movie->id)->doesntExist()) {
                            Trailer::create([
                                'key' => $video['key'],
                                'name' => $video['name'],
                                'site' => $video['site'],
                                'type' => $video['type'],
                                'movie_id' => $movie->id
                            ]);
                        }

                    }


                }
            }






            $this->addOrEditSeasonAndSeriesTMDB($movie->id, $idTMDB, $res->seasons);



        }



        return '';
    }



    public function addOrEditSeasonAndSeriesTMDB($movie_id = '', $tmdb_movieId = null, $seasons = null) {

        //$seasons = getSeasonsTMDB();


        if($seasons && $movie_id) {


            foreach($seasons as $season) {


                $season_update = Season::where('movie_id', $movie_id)->where('number', $season['season_number'])->first();

                if(!$season_update) {
                    $season_update = new Season;
                    $season_update->movie_id = $movie_id;
                }



                    $par = [
                        'language' => 'ru'
                    ];

                    $seasonInfoRu = apiCurlTmdb("tv/{$tmdb_movieId}/season/" . $season['season_number'], 'get', $par);





                    $par = [
                        'language' => 'en'
                    ];

                    $seasonInfoEn = apiCurlTmdb("tv/{$tmdb_movieId}/season/" . $season['season_number'], 'get', $par);






                    if (!$season_update->picture && isset($seasonInfoEn->poster_path)) {
                        $config = getConfigTmdb();
                        $poster_url = $config->images['secure_base_url'] . $config->images['poster_sizes'][3] . $seasonInfoEn->poster_path;
                        //$season_update->picture = remote_upload_file($poster_url, 'app/public/poster/serial/seasons');
                        $season_update->picture = $poster_url;
                    }

                    if($seasonInfoRu->overview) {
                        $season_update->description = $seasonInfoRu->overview;
                    }
                    if($seasonInfoEn->overview){
                        $season_update->description_en = $seasonInfoEn->overview;
                    }

                    $season_update->name = $seasonInfoRu->name;
                    $season_update->og_name = $seasonInfoEn->name;

                    $season_update->save();



                    if($seasonInfoEn->episodes) {

                        foreach ($seasonInfoEn->episodes as $k => $episodeEN) {

                            $serie = Serie::where('season_id', $season_update->id)->where('number', $episodeEN['episode_number'])->first();

                            if(!$serie) {
                                $serie = new Serie;
                                $serie->season_id = $season_update->id;
                            }



                                $serie->or_name = $episodeEN['name'];
                                $serie->description_en = $episodeEN['overview'];

                                if($episodeEN['air_date']) {
                                    $dateCarbon = Carbon::createFromFormat('Y-m-d', $episodeEN['air_date']);
                                    $serie->realease_date = $dateCarbon->format('Y-m-d H:i:s');
                                }

                                // русская информация
                                if($seasonInfoRu->episodes[$k]['episode_number'] == $episodeEN['episode_number']){
                                    $episodeRU = $seasonInfoRu->episodes[$k];
                                    $serie->name = $episodeRU['name'];
                                    $serie->description = $episodeRU['overview'];
                                }

                                // картинка
                            if (!$serie->picture && isset($episodeEN['still_path'])) {
                                $config = getConfigTmdb();
                                $still_url = $config->images['secure_base_url'] . 'original' . $episodeEN['still_path'];
                                //$serie->picture = remote_upload_file($still_url, 'app/public/still/serial/series');
                                $serie->picture = $still_url;
                            }


                            $serie->save();

                        }

                    }


            }




        }
    }




}
