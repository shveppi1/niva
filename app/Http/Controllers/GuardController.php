<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guarded;
use Illuminate\Support\Carbon;

class GuardController extends Controller
{

    private $code = 'voyunalunu';
    private $pref_code = '1xc202hh';

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

    public function checkCode(Request $request) {

        $req = $request->all();
        if(isset($req['code']) && $this->code == $req['code']) {


            return json_encode([
                'res' => 'ok',
                'val' => md5($this->pref_code . $req['code'])
            ]);

        } else {
            return json_encode(['res' => 'error']);
        }
    }

}
