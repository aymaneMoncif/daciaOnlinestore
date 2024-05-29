<?php

namespace App\Http\Controllers;

use App\Mail\dossierAchatMail;
use App\Mail\NotifiAdministration\ChargeeRCI\newDossierAchat;
use App\Mail\NotifiAdministration\Commercial\validationCredit;
use App\Models\Aport;
use App\Models\Client;
use App\Models\Commande;
use App\Models\DossierAchat;
use App\Models\Paiement;
use App\Models\Simulateur;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class DossierAchatController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /*------- Update commandes if 24h has passed ------
    public function updatedCommande($commandeID, $ClientID) {
        $commande = Commande::where('id', $commandeID)
            ->where('client_id', $ClientID)
            ->where('created_at', '<=', Carbon::now()->subHours(24))
            ->first();

        if ($commande) {
            // Update the status of the commande
            $commande->update(['Status_commande' => 'expired']);

            // Return the updated commande
            return $commande;
        } else {
            return null;
        }
    }
    //------- Update commandes if 24h has passed -------*/


    public function sendInfo()
    {

        $client = Auth::guard('client')->user();
        $id = $client->id;

        $commandeID = Commande::where('client_id', $id)->pluck('id')->first();

        $commande = Commande::find($commandeID);

        //check if there is a simulation
        $simulateur = Simulateur::where('client_id', $id)->first();

        if (!$simulateur) {
            return redirect('/paiement');
        }

        $version = $commande?->Version;
        $equipements = $commande?->equipements;

        $allapport = Aport::where('client_id', $id)->first();

        $isExpired = Commande::where('Status_commande', 'expired')
                    ->where('client_id', $id)
                    ->first();

        $allDossierAchat = DossierAchat::where('client_id', $id)->first();

        if ($allDossierAchat) {
            $DossierAchat = $allDossierAchat->getAttributes();

            $modepaiement_Validation = $DossierAchat['modepaiement_Validation'];
            $cin_Validation = $DossierAchat['cin_Validation'];
            $Attestationsalaire_Validation = $DossierAchat['Attestationsalaire_Validation'];
            $bulletinpaie_Validation = $DossierAchat['bulletinpaie_Validation'];
            $relevebancaire_Validation = $DossierAchat['relevebancaire_Validation'];
            $justificatifdomiciliation_Validation = $DossierAchat['justificatifdomiciliation_Validation'];
            $rib_Validation = $DossierAchat['rib_Validation'];
            $relevecnss_Validation = $DossierAchat['relevecnss_Validation'];
        }else{
            $modepaiement_Validation = null;
            $cin_Validation = null;
            $Attestationsalaire_Validation = null;
            $bulletinpaie_Validation = null;
            $relevebancaire_Validation = null;
            $justificatifdomiciliation_Validation = null;
            $rib_Validation = null;
            $relevecnss_Validation = null;


            $DossierAchat= null;
        }

        // Calculate $done
        $done = ($modepaiement_Validation === 'valider' &&
                $cin_Validation === 'valider' &&
                $Attestationsalaire_Validation === 'valider' &&
                $bulletinpaie_Validation === 'valider' &&
                $relevebancaire_Validation === 'valider' &&
                $justificatifdomiciliation_Validation === 'valider' &&
                $rib_Validation === 'valider' &&
                $relevecnss_Validation === 'valider');

        return view('dossierAchat', compact('commandeID','simulateur','isExpired','allapport','equipements','version','DossierAchat', 'modepaiement_Validation', 'cin_Validation', 'Attestationsalaire_Validation', 'bulletinpaie_Validation', 'relevebancaire_Validation', 'justificatifdomiciliation_Validation', 'rib_Validation', 'relevecnss_Validation', 'done'));
    }



    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'modepaiement' => 'required',
            'cin' => 'required|image',
            'Attestationsalaire' => 'required|image',
            'bulletinpaie' => 'required|image',
            'relevebancaire' => 'required|image',
            'justificatifdomiciliation' => 'required|image',
            'rib' => 'required|image',
            'relevecnss' => 'required|image',
        ]);


        // Get the authenticated user's ID
        $client = Auth::guard('client')->user();
        $idClient = $client->id;
        $email = $client->email;
        $Client = Client::find($idClient);

        // Get the commande ID for the authenticated user
        $commandeID = Commande::where('client_id', $idClient)->pluck('id')->first();

        // Define the folder name
        $folderName = 'dossierAchat';

        // Handle file upload
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $imagePath = $request->file($key)->store($folderName, 'public');
                $data[$key] = $imagePath;
            }
        }

        $data['client_id'] = $idClient;
        $data['commande_id'] = $commandeID;

        $DossierAchat = DossierAchat::create($data);
        // Send email with the password
        //Mail::to($email)->send(new dossierAchatMail($Client));


        //----//----    notif commercial & comptable    ----\\ ----\\
            $RCI = User::where('role_id', 6)->first();

            if (!$RCI) {
                throw new \Exception('Commercial user not found.');
            }

            //$RCIEmail = $RCI->email;
            $RCIName = $RCI->name;
            $RCIEmail = "aymaneatirao@gmail.com";

            $idClient = $DossierAchat->client_id;

            $user = Client::where('id', $idClient)->first();

            if (!$user) {
                throw new \Exception('User not found.');
            }

            $DateDepot = Carbon::parse($DossierAchat->created_at)->format('Y-m-d H:i:s');

            $emailData = [
                'RCIName' => $RCIName,
                'name' => $user->name,
                'prenom' => $user->prenom,
                'DateDepot' => $DateDepot,
            ];

            //try {
            //    if ($RCIEmail) {
            //        Mail::to($RCIEmail)->send(new newDossierAchat($emailData));
            //    }
            //} catch (Exception $e) {
                // Log the error or handle it as needed
                // You can choose to ignore the error and continue processing
            //}
        /*----sending email notifications -----*/

        return redirect()->back()->with('success', "Votre Dossier d'achat a bien été envoyé.");
    }



    public function sendInfoSuiviCMD()
    {
        $client = Auth::guard('client')->user();

        $id = $client->id;

        $commandeID = Commande::where('client_id', $id)->pluck('id')->first();

        $commande = Commande::find($commandeID);

        //check if there is a simulation
        $simulateur = Simulateur::where('client_id', $id)->first();

        $version = $commande?->Version;;
        $equipements = $commande?->equipements;

        $allapport = Aport::where('client_id', $id)->first();

        $isExpired = Commande::where('Status_commande', 'expired')
                    ->where('client_id', $id)
                    ->first();

        $allDossierAchat = DossierAchat::where('client_id', $id)->first();

        $allPaiement = Paiement::where('client_id', $id)->first();

        if ($allDossierAchat) {
            $DossierAchat = $allDossierAchat->getAttributes();

            $modepaiement_Validation = $DossierAchat['modepaiement_Validation'];
            $cin_Validation = $DossierAchat['cin_Validation'];
            $Attestationsalaire_Validation = $DossierAchat['Attestationsalaire_Validation'];
            $bulletinpaie_Validation = $DossierAchat['bulletinpaie_Validation'];
            $relevebancaire_Validation = $DossierAchat['relevebancaire_Validation'];
            $justificatifdomiciliation_Validation = $DossierAchat['justificatifdomiciliation_Validation'];
            $rib_Validation = $DossierAchat['rib_Validation'];
            $relevecnss_Validation = $DossierAchat['relevecnss_Validation'];
        } else {
            $modepaiement_Validation = null;
            $cin_Validation = null;
            $Attestationsalaire_Validation = null;
            $bulletinpaie_Validation = null;
            $relevebancaire_Validation = null;
            $justificatifdomiciliation_Validation = null;
            $rib_Validation = null;
            $relevecnss_Validation = null;

            $DossierAchat= null;
        }

        if ($allPaiement) {
            $Paiement = $allPaiement->getAttributes();

            $PaiementValidation = $Paiement['validation'];
        } else {
            $Paiement = null;
            $PaiementValidation = 0;
        }

        return view('psw_suivi', compact('client','commandeID','simulateur', 'isExpired', 'allapport', 'allPaiement', 'PaiementValidation', 'allDossierAchat', 'equipements', 'version', 'DossierAchat'));
    }


    public function edit(Request $request, $id){

        $dataTypeContent = DossierAchat::findOrFail($id);
        $users = Client::all();
        $commandes = Commande::all();

        return view('vendor.voyager.dossier_achats.edit', compact('dataTypeContent','users','commandes'));
    }

    public function update(Request $request, $id)
    {
        $DossierAchat = DossierAchat::find($id);

        $data = $request->validate([
            'modepaiement' => 'nullable',
            'modepaiement_Validation' => 'nullable',
            'cin' => 'nullable',
            'cin_Validation' => 'nullable',
            'Attestationsalaire' => 'nullable',
            'Attestationsalaire_Validation' => 'nullable',
            'bulletinpaie' => 'nullable',
            'bulletinpaie_Validation' => 'nullable',
            'relevebancaire' => 'nullable',
            'relevebancaire_Validation' => 'nullable',
            'justificatifdomiciliation' => 'nullable',
            'justificatifdomiciliation_Validation' => 'nullable',
            'rib' => 'nullable',
            'rib_Validation' => 'nullable',
            'relevecnss' => 'nullable',
            'relevecnss_Validation' => 'nullable',
            'client_id' => 'nullable',
            'RCIcomment' => 'nullable',
            'commande_id' => 'nullable',
        ]);

        $DossierAchat->update($data);


        /*----sending email notifications -----*/
        if (
            $DossierAchat->modepaiement_Validation == 'valider' &&
            $DossierAchat->cin_Validation == 'valider' &&
            $DossierAchat->Attestationsalaire_Validation == 'valider' &&
            $DossierAchat->bulletinpaie_Validation == 'valider' &&
            $DossierAchat->relevebancaire_Validation == 'valider' &&
            $DossierAchat->justificatifdomiciliation_Validation == 'valider' &&
            $DossierAchat->rib_Validation == 'valider' &&
            $DossierAchat->relevecnss_Validation == 'valider'
        ) {
            //----    notif commercial & comptable    ----\\
            $Commercial = User::where('role_id', 4)->first();

            if (!$Commercial) {
                throw new \Exception('Commercial user not found.');
            }

            //$CommercialEmail = $Commercial->email;
            $CommercialName = $Commercial->name;
            $CommercialEmail = "aymaneatirao@gmail.com";

            $idClient = $DossierAchat->client_id;
            $Statut = $DossierAchat->RCIcomment;

            $user = Client::where('id', $idClient)->first();

            if (!$user) {
                throw new \Exception('User not found.');
            }

            $DateCreation = Carbon::parse($DossierAchat->updated_at)->format('Y-m-d H:i:s');

            $emailData = [
                'CommercialName' => $CommercialName,
                'name' => $user->name,
                'prenom' => $user->prenom,
                'Statut' => $Statut,
                'DateCreation' => $DateCreation,
            ];

            //try {
            //    if ($CommercialEmail) {
            //        Mail::to($CommercialEmail)->send(new validationCredit($emailData));
            //    }
            //} catch (Exception $e) {
                // Log the error or handle it as needed
                // You can choose to ignore the error and continue processing
            //}
            /*----sending email notifications -----*/
        }

        return redirect('admin/dossier-achats');
    }

}
