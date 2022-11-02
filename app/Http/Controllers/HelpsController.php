<?php

namespace App\Http\Controllers;

use App\Models\Regulation;

class HelpsController extends Controller
{
    private $code = 'lip48';
    private $pref_code = '1xc202hh';

    public function helps() {

        $regulations = Regulation::NotClubs()
            ->Active()
            ->orderBy('sort', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('regulation.lists', compact('regulations'));
    }


    public function helpsClub() {


        $showPage = 0;

        if(\Auth::user() && \Auth::user()->groups()->first()) {
            foreach(\Auth::user()->groups as $group) {
                if($group->id == 2) {
                    $showPage = 1;
                }
            }
        }


        if(!$showPage
            && isset($_COOKIE['guard'])
            && $_COOKIE['guard'] == md5($this->pref_code . $this->code) )
        {
            $showPage = 1;
        }


        if($showPage) {
            $regulations = Regulation::Clubs()
                ->Active()
                ->orderBy('sort', 'asc')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
            return view('regulation.lists', compact('regulations'));
        } else {
            return view('regulation.code');
        }

    }


    public function helpsDetail($id) {

        $regulation = Regulation::Active()->findOrFail($id);

        if($regulation->private == 1){

            $showPage = 0;

            if(\Auth::user() && \Auth::user()->groups()->first()) {
                foreach(\Auth::user()->groups as $group) {
                    if($group->id == 2) {
                        $showPage = 1;
                    }
                }
            }

            if(!$showPage
                && isset($_COOKIE['guard'])
                && $_COOKIE['guard'] == md5($this->pref_code . $this->code) )
            {
                $showPage = 1;
            }

            if($showPage) {
                return view('regulation.detail', compact('regulation'));
            } else {
                return view('regulation.code');
            }

        } else {
            return view('regulation.detail', compact('regulation'));
        }



    }
}
