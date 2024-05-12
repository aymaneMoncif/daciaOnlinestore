<?php

namespace App\Http\Controllers\cardpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class cardPaymentController extends Controller{

    //decrept the data
    public function confirmpaie(Request $request){

        // Get the request URI
        $requestUri = $request->getRequestUri();

        // Extract query parameters from the request URI
        $parameters = [];
        parse_str(parse_url($requestUri, PHP_URL_QUERY), $parameters);

        // Check if 'data' and 'codecmr' parameters exist in the extracted parameters
        if (isset($parameters['data']) && isset($parameters['codecmr'])) {
            $data = $parameters['data'];
            $codecmr = $parameters['codecmr'];
            Session::put('codecmr', $codecmr);
        }

        return view('confirmation/confirmpaie', compact('data', 'codecmr'));
    }


    //check the data
    public function envoimailconfirmation(Request $request){
        $repauto=$request->input('repauto');

        $email=$request->input('email');

        $montant=$request->input('montant');

        $id_commande=$request->input('id_commande');

        $numTrans=$request->input('numTrans');
        $numTrans = str_replace('signature',' ',$numTrans);

        $nmtrx=$request->input('numAuto');
        $numtrx = str_replace('signature',' ',$nmtrx);

        $signature=$request->input('signature');

        $clepub="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh2q4viqQwzVWCKT1KRPvsiixEoNm8dg95gE7h4OUVuERp9csLKYHM9I9EaQ/SUYwgBBLHOslpe5qbvX3x1oAcksO5BT8SYHmtbgUpH1yZjcU1lI2/M3qyRUb03NQaF6vgxCOLGlLpDQqdg0jxl4ySDYu3bcMQto6J2eRAnIPIZkC/h4GQMwhBheFEHf7uMCqj8uNkNf5yU1Js9/Yj8FGbS1fSYwQ1ZQ7Jr94eUhCuTgjFKYUxD18QIPgYEnYbir4mKagtnF8fv3S1+COsVlUXkix77KGW5SYMbeJJYtOVTs1/Cr+/8eHRf5al5249binOJxWLkANpsZtLNI60i9UUQIDAQAB";
        $msgahash=$id_commande.$clepub;
        $hashagegenere=MD5($msgahash);

        $typecrt = substr($request->input('numCarte'), 0, 1);

        $bincart = substr($request->input('numCarte'), 0, 6);
        $bincmi=array('505823','601506','601586','602586','604851','621983','627695','639412');

        if (in_array($bincart, $bincmi))
        {

        }else{
            switch ($typecrt) {
                case "4":
                    $typecrt = "VISA";

                break;
                case "5":
                    $typecrt = "MASTERCARD";

                break;
                case "6":
                    $typecrt = "MAESTRO";
                break;
                default:
                    $typecrt = "";
                break;
            }
        }

        $montant=number_format($request->input('montant'),2);

        $codecmr=$request->input('codecmr');
        $date=date("Y-m-d H:i:s");
        $codecmr=$_POST['codecmr'];


        if( $repauto == "91" && ($hashagegenere == $signature || $hashagegenere == "0".$signature) ) // paiement ok
        { //update BD
            //envoi mail
            //envoi SMS

            //$idmsg = "1ok";
            return response()->json("1ok");
        }
        else //paiement ko
        {
            //update BD
            //$idmsg ="3ko";
            return response()->json("3ko");
        }
    }


    public function msgconfirm(Request $request){

        dd($request);
        $idmsg = $request->idmsg;
        $email = $request->email;

        return view('confirmation.msgconfirm', compact('idmsg', 'email'));
    }

}
