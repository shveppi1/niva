<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApsController extends Controller
{

    public function getMap(Request $request) {

        $req = $request->all();

        $jsong['sokol'] = '<p>Адрес: г. Липецк, пл. Заводская, 9 (Свободный Сокол)</p>

        					<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A97a77c8b2c174baf04ddbe5e8201d964765364b9f835f89c19f3d374e4a29e7d&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe><div style="clear: both;"></div>';

        $jsong['gryazi'] = 		'<p>Адрес: г. Грязи, ул. Осоавиахима, 6</p>

        					<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A20431262b48c4fac16b19077ad5402efcbe5911b44e7bf275b121be1b3de4f17&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe><div style="clear: both;"></div>';

        $jsong['sirskiy'] = '<p>Адрес: г. Липецк, пр. Ударников 24А (Сырский рудник, остановка "школа 23")</p>

		                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7455a0aababc5d6a0f31b6eb7c47d54e2b8540a8533549af62c3438c8f78c16b&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe><div style="clear: both;"></div>';


        return json_encode($jsong[$req['getMap']]);

    }



    public function getGallery(Request $request) {

        $req = $request->all();

        $jsong = [];

        if($req['getFile'] == 'gallery1') {
            $jsong[] = array('src' => '/images/img/gallery1/1.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пр. Ударников 24а',
                    'thumb' => '/images/img/gallery1/1.jpg'
                )
            );

            $jsong[] = array('src' => '/images/img/gallery1/2.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пр. Ударников 24а',
                    'thumb' => '/images/img/gallery1/2.jpg'
                )
            );

            $jsong[] = array('src' => '/images/img/gallery1/3.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пр. Ударников 24а',
                    'thumb' => '/images/img/gallery1/3.jpg'
                )
            );

            $jsong[] = array('src' => '/images/img/gallery1/4.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пр. Ударников 24а',
                    'thumb' => '/images/img/gallery1/4.jpg'
                )
            );
        }


        if($req['getFile'] == 'gallery2') {

            $jsong[] = Array('src'  => '/images/img/gallery2/1.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пл. Заводская, 9 (р-он Сокол)',
                    'thumb'   => '/images/img/gallery2/1.jpg'
                )
            );

            $jsong[] = Array('src'  => '/images/img/gallery2/2.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пл. Заводская, 9 (р-он Сокол)',
                    'thumb'   => '/images/img/gallery2/2.jpg'
                )
            );

            $jsong[] = Array('src'  => '/images/img/gallery2/3.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Липецк, пл. Заводская, 9 (р-он Сокол)',
                    'thumb'   => '/images/img/gallery2/3.jpg'
                )
            );

        }

        if($req['getFile'] == 'gallery3') {

            $jsong[] = Array('src'  => '/images/img/gallery3/1.jpg',
                'opts' => array(
                    'caption' => 'Адрес: г. Грязи, ул. Осоавиахима, 6',
                    'thumb'   => '/images/img/gallery3/1.jpg'
                )
            );

        }


        return json_encode($jsong);

    }

}
