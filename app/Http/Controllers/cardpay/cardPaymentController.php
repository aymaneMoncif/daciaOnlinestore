<?php

namespace App\Http\Controllers\cardpay;

use App\Http\Controllers\Controller;
use App\Models\cardpayment;
use Illuminate\Http\Request;
use App\Mail\apportMail;
use App\Models\Aport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    public function envoimailconfirmation(Request $request)
    {
        // Extract data from the request
        $codecmr = $request->input('codecmr');
        $repauto = $request->input('repauto');
        $numAuto = $request->input('numAuto');
        $email = $request->input('email');
        $nomprenom = $request->input('nomprenom');
        $numTrans = $request->input('numTrans');
        $numCarte = $request->input('numCarte');
        $typecarte = $request->input('typecarte');
        $montantNormale = $request->input('montant');
        $signature = $request->input('signature');
        $id_commande = $request->input('id_commande');

        // Format the montant value
        $montant = number_format($montantNormale, 2);

        // Generate the hash for verification
        $clepub = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh2q4viqQwzVWCKT1KRPvsiixEoNm8dg95gE7h4OUVuERp9csLKYHM9I9EaQ/SUYwgBBLHOslpe5qbvX3x1oAcksO5BT8SYHmtbgUpH1yZjcU1lI2/M3qyRUb03NQaF6vgxCOLGlLpDQqdg0jxl4ySDYu3bcMQto6J2eRAnIPIZkC/h4GQMwhBheFEHf7uMCqj8uNkNf5yU1Js9/Yj8FGbS1fSYwQ1ZQ7Jr94eUhCuTgjFKYUxD18QIPgYEnYbir4mKagtnF8fv3S1+COsVlUXkix77KGW5SYMbeJJYtOVTs1/Cr+/8eHRf5al5249binOJxWLkANpsZtLNI60i9UUQIDAQAB";
        $msgahash = $id_commande . $clepub;
        $hashagegenere = MD5($msgahash);

        // Check if payment is successful
        if ($repauto == "00" && ($hashagegenere == $signature || $hashagegenere == "0" . $signature)) {
            // Payment is successful,
            $idmsg = "1ok";
        } else {
            // Payment failed,
            $idmsg = "3ko";
        }

        // Create an array with the data to be stored in the database
        $data = [
            'codecmr' => $codecmr,
            'repauto' => $repauto,
            'numautorisation' => $numAuto,
            'emailrd' => $email,
            'nomprenom' => $nomprenom,
            'numTrans' => $numTrans,
            'numCarte' => $numCarte,
            'typecarte' => $typecarte,
            'montant' => $montant,
            'signature' => $signature,
            'id_commande' => $id_commande,
            'nom_cmr' => 'NAPS',
            'idmsg' => $idmsg,
        ];

        // Create the card payment record
        $Client = Auth::guard('client')->user();

        $dataApport = [
            'nombanque' => 'non',
            'numerotransaction' => 'non',
            'imagerecu' => 'non',
            'type_paiement' => 'Par card',
            'client_id' => $Client->id,
        ];

        // Return JSON response based on payment status
        if ($idmsg == "1ok") {

            // Insert new apport
            $Aport = Aport::create($dataApport);

            // Add id_apport to the existing data array
            $data['id_apport'] = $Aport->id;

            // Insert new payment
            CardPayment::create($data);

            // Send email with the password to the client
            //Mail::to($email)->send(new apportMail($Client));

            return response()->json("1ok");
        } else {
            //insert new payment
            CardPayment::create($data);
            return response()->json("3ko");
        }
    }



    public function msgconfirm(Request $request)
    {
        // Get the email address from the request
        $idmsg = $request->idmsg;
        $email = $request->email;

        //dd($idmsg);

        // Query the CardPayment model to find data related to the email
        $data = CardPayment::where('emailrd', $email)->first();

        // Return the data to the view
        return view('confirmation.msgconfirm', compact('data', 'idmsg', 'email'));
    }


}
