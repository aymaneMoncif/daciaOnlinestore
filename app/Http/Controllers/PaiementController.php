<?php

namespace App\Http\Controllers;

use App\Mail\paiementMail;
use App\Models\Aport;
use App\Models\Commande;
use App\Models\DossierAchat;
use App\Models\Paiement;
use App\Models\Simulateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class PaiementController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendInfoPaiement()
    {
        $id = Auth::user()->id;

        $commandeID = Commande::where('client_id', $id)->pluck('id')->first();

        //check if there is a simulation
        $simulateur = Simulateur::where('client_id', $id)->first();

        $commande = Commande::find($commandeID);
        
        $version = $commande?->Version;;
        $equipements = $commande?->equipements;       

        $allDossierAchat = DossierAchat::where('client_id', $id)->first();
        $allapport = Aport::where('client_id', $id)->first();

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

        if (!$simulateur && !$allapport?->comptable_validation) {
            return redirect('/validationCommande');
        }elseif($simulateur && !$done){
            return redirect('/dossierAchat');
        }

        $allPaiement = Paiement::where('client_id', $id)->first();

        if ($allPaiement) {
            $Paiement = $allPaiement->getAttributes();

            $PaiementValidation = $Paiement['validation'];
        }else{
            $Paiement = null;
            $PaiementValidation = 0;
        }

        return view('paiement', compact('commandeID','done','commande','equipements','version','Paiement','PaiementValidation','simulateur'));
    }



    public function userStorePaiement(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'modepaiement' => 'required',
            'methodepaiement' => 'required',
            'nombanque' => 'required',
            'numtransaction' => 'required',
            'imagerecu' => 'required|image',
        ]);

        // Get the authenticated user's ID
        $idClient = Auth::user()->id;
        $email = Auth::user()->email;
        $Client = User::find($idClient);

        // Get the commande ID for the authenticated user
        $commandeID = Commande::where('client_id', $idClient)->pluck('id')->first();

        // Handle file upload
        if ($request->hasFile('imagerecu')) {
            $imagePath = $request->file('imagerecu')->store('paiementrecu', 'public');
            $data['imagerecu'] = $imagePath;
        }

        $data['client_id'] = $idClient;
        $data['commande_id'] = $commandeID;

        // Create new Aport instance and save data
        Paiement::create($data);

        // Send email with the password
        Mail::to($email)->send(new paiementMail($Client));

        return redirect()->back()->with('success', "Votre Paiement a bien été envoyé.");
    }


    public function sendInfoLivraison()
    {
        $id = Auth::user()->id;

        $commandeID = Commande::where('client_id', $id)->pluck('id')->first();

        //check if there is a simulation
        $simulateur = Simulateur::where('client_id', $id)->first();

        $commande = Commande::find($commandeID);
        
        $version = $commande?->Version;;
        $equipements = $commande?->equipements;       

        $allPaiement = Paiement::where('client_id', $id)->first();

        //$allaport = Aport::where('client_id', $id)->first();

        if ($allPaiement) {
            $Paiement = $allPaiement->getAttributes();

            $PaiementValidation = $Paiement['validation'];
        }else{
            $Paiement = null;
            $PaiementValidation = 0;
        }

        return view('livraison', compact('commandeID','equipements','version','Paiement','PaiementValidation','simulateur'));
    }


    public function edit(Request $request, $id)
    {
        $dataTypeContent = Paiement::findOrFail($id);

        $idCommande = $dataTypeContent->commande_id;

        $simulateur = Simulateur::where('command_id', $idCommande)->first();
        
        $commande = Commande::with('client','modele','version','Aport')->find($idCommande);

        $users = User::all();
        $commandes = Commande::all();

        return view('vendor.voyager.paiements.edit', compact('commande','simulateur','commandes','users','dataTypeContent'));
    }

}
