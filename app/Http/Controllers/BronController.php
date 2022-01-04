<?php

namespace App\Http\Controllers;



use App\Models\Bron;
use Illuminate\Support\Facades\DB;

class BronController extends Controller
{

    public function index() {

        $updates = Bron::where('created_at', ">=", DB::raw('NOW() - INTERVAL 2 WEEK'))->where('action', 'update')->orderByDesc('id')->get();
        $edites = Bron::where('created_at', ">=", DB::raw('NOW() - INTERVAL 2 WEEK'))->where('action', 'edit')->orderByDesc('id')->get();


        $arrUpdate = [];
        foreach($updates as $update) {
            $data = json_decode($update->data, true);



            if(isset($data['StoreId'])) {

                if (!isset($arrUpdate[$data['StoreId']])) {


                    $arrUpdate[$data['StoreId']]['id'] = $data['StoreId'];
                    $arrUpdate[$data['StoreId']]['bron'] = $data['StoreSklad_newbron'];
                    if(isset($data['StoreNumber'])) {
                        $arrUpdate[$data['StoreId']]['StoreNumber'] = $data['StoreNumber'];
                    }

                    if(isset($data['StoreAdres'])) {
                        $arrUpdate[$data['StoreId']]['StoreAdres'] = $data['StoreAdres'];
                    }

                    if(isset($data['full_address'])) {
                        $arrUpdate[$data['StoreId']]['full_address'] = $data['full_address'];
                    }

                }

            }

            //echo '<pre>'; print_r($data); echo '</pre>';

            //echo '<pre>'; print_r($arrUpdate); echo '</pre>';

            //die();

        }




        //echo '<pre>'; print_r($arrUpdate); echo '</pre>';

        $arrEdit = [];

        foreach($edites as $edit) {

            $dataEdit = json_decode($edit->data, true);

            if(isset($dataEdit['StoreId'])) {



                    $arrEdit[$dataEdit['StoreId']][] = $dataEdit['StoreSklad_newbron'];



            }


        }


        //echo '<pre>'; print_r($arrEdit); echo '</pre>';

        //die();



        $arUpdateis = [];

        foreach($arrEdit as $k => $ed) {
            foreach($ed as $editt) {
                if(isset($arrUpdate[$k])) {
                    if ($editt != $arrUpdate[$k]['bron']) {
                        $arUpdateis[$k] = $arrUpdate[$k];
                    }
                }
            }

        }

        //echo '<pre>'; print_r($arUpdateis); echo '</pre>';


        //$html='';
        foreach ($arUpdateis as $k => $upd) {

            echo $upd["full_address"] . '<br />';
/*
            $html .= '<tr>';
            $html .= '<td>id: '. $k . '</td>';
            $html .= '<td>StoreNumber: '. $upd["StoreNumber"] . '</td>';
            $html .= '</tr>';
*/
        }

        //echo '<table>'.$html.'</table>';


    }

}
