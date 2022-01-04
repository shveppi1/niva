<?php

namespace App\Http\Controllers;


use App\Models\Movie;

class TestController extends Controller
{
    public function index() {

        $movie = new Movie();

        $movie->name = 'тест2';
        $movie->slug = 'test2';
        $movie->author_id = 1;
        $movie->category_id = 1;
        $movie->picture = 'https://images.unsplash.com/photo-1641236709013-3e1583f4a53d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwzfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60';

        $movie->save();

    }
}
