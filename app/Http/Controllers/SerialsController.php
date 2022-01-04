<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Season;
use Illuminate\Http\Request;

class SerialsController extends Controller
{

    public function index() {

        $serials = Movie::latest()->paginate(30);

            //dd($serials);


        return view('page.serial.serials', compact('serials'));
    }


    public function detail ($slug) {

        $serial = Movie::where('slug', $slug)->first();

        return view('page.serial.detail', compact('serial'));

    }

}
