<?php

namespace App\Http\Controllers;

use App\Models\Regulation;

class HelpsController extends Controller
{
    public function helps() {

        $regulations = Regulation::NotClubs()->limit(10)->get();

        return view('regulation.lists', compact('regulations'));
    }


    public function helpsClub() {

        if(isset($_COOKIE['guard']) && $_COOKIE['guard'] == getCodePrivet() ) {
            $regulations = Regulation::Clubs()->limit(10)->get();
            return view('regulation.lists', compact('regulations'));
        } else {
            return view('regulation.code');
        }

    }


    public function helpsDetail($id) {

        $regulation = Regulation::findOrFail($id);

        if($regulation->private == 1){
            return view('regulation.code');
        } else {
            return view('regulation.detail', compact('regulation'));
        }



    }
}
