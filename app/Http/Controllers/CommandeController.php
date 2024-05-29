<?php

namespace App\Http\Controllers;

use App\Mail\NotifiAdministration\Commercial\Cmntcallcenter;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Couleur;
use App\Models\Equipement;
use App\Models\Modele;
use App\Models\Simulateur;
use App\Models\Stock;
use App\Models\User;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\Mail;

class CommandeController extends VoyagerBaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'modele_id' => 'required',
            'version_id' => 'required',
            'couleur_id' => 'required',
            'client_id' => 'required',
            'equipements' => 'nullable|array',
            'total' => 'required',
        ]);

        // Update the stock status to 'pré-réservation' and retrieve the ID of the updated stock
        $updatedStock = Stock::where('modele_id', $validatedData['modele_id'])
            ->where('version_id', $validatedData['version_id'])
            ->where('id_couleur', $validatedData['couleur_id'])
            ->where('status', null)
            ->first();

        if ($updatedStock) {
            // Update the stock status and client_id
            $updatedStock->update([
                'status' => 'pré-réservation',
                'client_Id' => $validatedData['client_id'],
            ]);

            // Retrieve the ID of the updated stock
            $n_chassis = $updatedStock->id;
        } else {
            // Handle the case where no stock was updated
            return response()->json(['error' => 'No stock available for pré-réservation'], 404);
        }

        // Add the n_chassis to the validated data
        $validatedData['n_chassis'] = $n_chassis;

        // Create the Commande
        $commande = Commande::create($validatedData);

        // Convert the equipements object to an array of IDs
        $equipementIds = array_keys($validatedData['equipements']);

        // Attach equipements to the Commande
        $commande->equipements()->attach($equipementIds);

        // Return the created Commande as a JSON response
        return response()->json(['message' => 'Commande created successfully', 'commande' => $commande], 201);
    }




    public function edit(Request $request, $id)
    {
        $commande = Commande::with('client','modele','version','Aport')->findOrFail($id);

        $equipementsSelected = Equipement::whereHas('commandes', function ($query) use ($id) {
            $query->where('commande_id',$id);
        })->get();

        $modeles = Modele::All();

        $versions = Version::All();

        $couleurs = Couleur::All();

        $equipements = Equipement::All();

        return view('vendor.voyager.Commandes.edit-add', compact('commande','modeles','versions','couleurs','equipements','equipementsSelected'));
    }


    public function updateCustomFields(Request $request, $id)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'CC_status' => 'nullable|string',
                'CC_Comment' => 'nullable|string',
                'Commercial_Status' => 'nullable|string',
                'Commercial_Comment' => 'nullable|string',
            ]);

            // Find the record by ID
            $record = Commande::findOrFail($id);

            // Update the specific fields
            $record->update($validatedData);

            $Commercial = User::where('role_id', 4)->first();
            if (!$Commercial) {
                throw new \Exception('Commercial user not found.');
            }

            //$CommercialEmail = $Commercial->email;
            $CommercialName = $Commercial->name;
            $CommercialEmail = "aymaneatirao@gmail.com";

            $idcommande = $record->id;
            $idClient = $record->client_id;
            $idModele = $record->modele_id;
            $idVersion = $record->version_id;

            $simulation = Simulateur::where('command_id', $idcommande)->first();

            $financement = $simulation ? 'Crédit' : 'Comptant';
            $user = Client::where('id', $idClient)->first();
            $Version = Version::where('id', $idVersion)->first();
            $Modele = Modele::where('id', $idModele)->first();

            if (!$user || !$Version || !$Modele) {
                throw new \Exception('User, Version, or Modele not found.');
            }

            $CC_status = $record->CC_status;
            $Date_status = Carbon::parse($record->updated_at)->format('Y-m-d H:i:s');

            $emailData = [
                'CommercialName' => $CommercialName,
                'name' => $user->name,
                'prenom' => $user->prenom,
                'nommodele' => $Modele->nommodele,
                'nomversion' => $Version->nomversion,
                'financement' => $financement,
                'CC_status' => $CC_status,
                'Date_status' => $Date_status,
            ];

            //if ($CommercialEmail) {
                // Send email with the password to the client
            //    Mail::to($CommercialEmail)->send(new Cmntcallcenter($emailData));
            //}

            // Optionally, you can return a response indicating success or failure
            return redirect()->to('admin/commandes')->with('success', 'Custom fields updated successfully');
        } catch (\Exception $e) {
            // Handle the exception, log it, and return an error response
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



    public function StoreSimulateur(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'type' => 'required',
            'apport' => 'required',
            'durree' => 'required',
            'taux' => 'required',
            'fraisdossier' => 'required',
            'mensualite' => 'required',
            'command_id' => 'required',
            'client_id' => 'required',
        ]);

        Simulateur::create($validatedData);

        return response()->json(['message'=>'simulateur created successfully', 'data' => $validatedData], 201);
    }
}
