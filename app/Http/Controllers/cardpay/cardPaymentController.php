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
        $clepub = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0ICFCzkw9FEAV+khE023ZxDC/wsG8A2Any7a4UePXfTWE1+JXeHIoXLXwXGHa8JyrE49Y9DoWHIgNFdPXFUftT8+gdI75g2HPG2116d4yyAKpWfqWZkmbxkOa0UTEnBZP0WEU8uQI6XKKciBPlrAX1O9mVHqoLBCxUFS5img7xJmIyeVHtcHbd2eaKy4PdmqE5GsQfnt+x853ZJDA1iXhxJALylo2R5dV0644fijS5IzvyN8dQ0UJmyv0Hu3YLoWwVH0kfXhEhm/Ka3dXW1rcRnfArR75rD+cn49wpgXSbtFWqP0WOujdl07lq2U217O7VFnKveRIDk6dDsyC08wdwIDAQAB";
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
        $Client = Auth::user();

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
