<?php

namespace App\Http\Controllers;

use App\Models\Guarded;
use Illuminate\Support\Carbon;

class GuardController extends Controller
{

    private $code = 'voyunalunu';

    public function addHash($code) {

        if($code == $this->code) {
            $hash = 123456;
            Guarded::save(['hash' => $hash]);
            return json_encode(['res' => 'ok', 'hash' => $hash]);
        } else {
            return json_encode(['res' => 'error']);
        }
    }

    public function checkHash($hash) {
        if(Guarded::where(['hash' => $hash])->where('created_at' > Carbon::now()->subDay())->first()) {
            return json_encode(['res' => 'ok']);
        } else {
            return json_encode(['res' => 'error']);
        }
    }

}
