<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    public function index() {

        /*
        $db = DB::table('movies')
            ->leftJoin('seasons as se', 'movies.id', '=', 'se.movie_id')
            ->leftJoin('series as ser', 'se.id', '=', 'ser.season_id')
            ->select('movies.name', 'movies.name_original', 'movies.picture', 'ser.number', 'ser.realease_date', 'se.number')
            ->where('ser.realease_date', '>=', Carbon::now())
            ->groupBy('movies.id')->get();
        */

        $serials = Serie::where('realease_date', '>=', Carbon::now())->orderBy('realease_date')->paginate(50);


        return view('page.main', compact('serials'));
    }
}
