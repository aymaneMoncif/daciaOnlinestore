<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;

class guestController extends Controller{

    public function StoreGuest(Request $request){
        
        $validatedData = $request->validate([
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'email' => 'required','email',
            'tele' =>'required|max:15|min:10',
            'ville' => 'required|max:255',
            'testDrive' => 'boolean',
            'Etape' => 'nullable',
        ]);
    
        $guest = Guest::create($validatedData);
        $modele = $request->modele;
        
        // Call the apitelus service and store the result
        $apitelusResponse = $this->apitelus($guest, $modele);

        // Prepare the response data
        $responseData = [
            'guest' => $guest,
            'apitelusResponse' => $apitelusResponse,
        ];

        return response()->json($responseData, 200);
    }


    public function apitelus($guest, $modele)
    {

        // Define CRM API endpoint
        $crmEndpoint = 'https://www.tccsv39.com/PIXYAPI/Save_Ld_Pixy.php';
        
        $secret_key = 'TelusZv36pG9rTHaAgmEM';
        $secret_iv = 'TelusRCvKJudVGKdyA9HW';
        $user = 'telusAPI';
        $mdp = 'Pixy2021';
    
        // Concatenate user and mdp
        $all = $user . $mdp;
    
        // Encryption method and generate key and iv
        $encrypt_method = 'AES-256-CBC';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        // Generate HMAC
        $hmac = openssl_encrypt($all, $encrypt_method, $key, 0, $iv);
    
        // Encode HMAC using base64
        $PassKey = base64_encode($hmac);
    
        $data = [
            'PassKey' => $PassKey,
            'email' => $guest->email,
            'civilite' => 'null',
            'nom' => $guest->nom,
            'prenom' => $guest->prenom,
            'ville' => $guest->ville,
            'modele' => $modele,
            'telephone' => $guest->tele,
            'type_demande' => 'Afficher le prix réduit',
            'Date_demande' => $guest->created_at->format('Y-m-d H:i:s'),
            'Nom_compagne' => 'null',
            'priorite' => 'normale',
            'content' => 'null',
            'origin' => 'Web',
            'appelvideo' => 'No',
            'reprise' => 'No',
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $crmEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
        ]);
    
        $response = curl_exec($curl);
    
        curl_close($curl);
    
        // Check the API response
        switch ($response) {
            case "0":
                return response()->json(['error' => 'PassKey erroné'], 400);
            case "1":
                return response()->json(['error' => 'Donnés importante manquante'], 400);
            case "2":
                return response()->json(['error' => 'Insertion en double'], 400);
            case "3":
                return response()->json(['message' => 'Insertion réussie'], 200);
            case "4":
                return response()->json(['error' => 'Erreur d’insertion'], 400);
            default:
                return response()->json(['error' => $response], 500);
        }
    }

    public function UpdateGuest(Request $request){

        $validatedData = $request->validate([
            'id' => 'required|exists:guests,id',
            'Etape' => 'required|string|max:255'
        ]);

        $guest = Guest::findOrFail($validatedData['id']);

        $guest->Etape = $validatedData['Etape'];

        $guest->save();

        return response()->json(['message' => 'Guest steps updated successfully', 'guest' => $guest]);
    }
    
    
}