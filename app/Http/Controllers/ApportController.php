<?php

namespace App\Http\Controllers;

use App\Mail\apportMail;
use App\Mail\NotifiAdministration\Comptable\newApport;
use App\Mail\NotifiAdministration\Commercial\reglementApport;
use App\Models\Aport;
use App\Models\Commande;
use App\Models\DossierAchat;
use App\Models\Modele;
use App\Models\Simulateur;
use App\Models\Stock;
use App\Models\User;
use App\Models\Version;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;

class ApportController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     
     public function index(Request $request)
     {
         // GET THE SLUG, ex. 'posts', 'pages', etc.
         $slug = $this->getSlug($request);
 
         // GET THE DataType based on the slug
         $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
 
         // Check permission
         $this->authorize('browse', app($dataType->model_name));
 
         $getter = $dataType->server_side ? 'paginate' : 'get';
 
         $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
 
         $searchNames = [];
         if ($dataType->server_side) {
             $searchNames = $dataType->browseRows->mapWithKeys(function ($row) {
                 return [$row['field'] => $row->getTranslatedAttribute('display_name')];
             });
         }
 
         $orderBy = $request->get('order_by', $dataType->order_column);
         $sortOrder = $request->get('sort_order', $dataType->order_direction);
         $usesSoftDeletes = false;
         $showSoftDeleted = false;
 
         // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
         if (strlen($dataType->model_name) != 0) {
             $model = app($dataType->model_name);
 
             $query = $model::select($dataType->name.'.*');
 
             if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                 $query->{$dataType->scope}();
             }
 
             // Use withTrashed() if model uses SoftDeletes and if toggle is selected
             if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                 $usesSoftDeletes = true;
 
                 if ($request->get('showSoftDeleted')) {
                     $showSoftDeleted = true;
                     $query = $query->withTrashed();
                 }
             }
 
             // If a column has a relationship associated with it, we do not want to show that field
             $this->removeRelationshipField($dataType, 'browse');
 
             if ($search->value != '' && $search->key && $search->filter) {
                 $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                 $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
 
                 $searchField = $dataType->name.'.'.$search->key;
                 if ($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)) {
                     $query->whereIn(
                         $searchField,
                         $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray()
                     );
                 } else {
                     if ($dataType->browseRows->pluck('field')->contains($search->key)) {
                         $query->where($searchField, $search_filter, $search_value);
                     }
                 }
             }
 
             $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
             if ($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))) {
                 $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                 if (!empty($row)) {
                     $query->select([
                         $dataType->name.'.*',
                         'joined.'.$row->details->label.' as '.$orderBy,
                     ])->leftJoin(
                         $row->details->table.' as joined',
                         $dataType->name.'.'.$row->details->column,
                         'joined.'.$row->details->key
                     );
                 }
 
                 $dataTypeContent = call_user_func([
                     $query->orderBy($orderBy, $querySortOrder),
                     $getter,
                 ]);
             } elseif ($model->timestamps) {
                 $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
             } else {
                 $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
             }
 
             // Replace relationships' keys for labels and create READ links if a slug is provided.
             $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
         } else {
             // If Model doesn't exist, get data from table name
             $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
             $model = false;
         }
 
         // Check if BREAD is Translatable
         $isModelTranslatable = is_bread_translatable($model);
 
         // Eagerload Relations
         $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);
 
         // Check if server side pagination is enabled
         $isServerSide = isset($dataType->server_side) && $dataType->server_side;
 
         // Check if a default search key is set
         $defaultSearchKey = $dataType->default_search_key ?? null;
 
         // Actions
         $actions = [];
         if (!empty($dataTypeContent->first())) {
             foreach (Voyager::actions() as $action) {
                 $action = new $action($dataType, $dataTypeContent->first());
 
                 if ($action->shouldActionDisplayOnDataType()) {
                     $actions[] = $action;
                 }
             }
         }
 
         // Define showCheckboxColumn
         $showCheckboxColumn = false;
         if (Auth::user()->can('delete', app($dataType->model_name))) {
             $showCheckboxColumn = true;
         } else {
             foreach ($actions as $action) {
                 if (method_exists($action, 'massAction')) {
                     $showCheckboxColumn = true;
                 }
             }
         }
 
         // Define orderColumn
         $orderColumn = [];
         if ($orderBy) {
             $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
             $orderColumn = [[$index, $sortOrder ?? 'desc']];
         }
 
         // Define list of columns that can be sorted server side
         $sortableColumns = $this->getSortableColumns($dataType->browseRows);
 
         $view = 'voyager::bread.browse';
 
         if (view()->exists("voyager::$slug.browse")) {
             $view = "voyager::$slug.browse";
         }

         $apports = Aport::with('user')->get();
            //dd($dataTypeContent);
         return Voyager::view('vendor.voyager.apports.index', compact(
             'actions',
             'apports',
             'dataType',
             'dataTypeContent',
             'isModelTranslatable',
             'search',
             'orderBy',
             'orderColumn',
             'sortableColumns',
             'sortOrder',
             'searchNames',
             'isServerSide',
             'defaultSearchKey',
             'usesSoftDeletes',
             'showSoftDeleted',
             'showCheckboxColumn'
         ));
     }


    public function edit(Request $request, $id){

        $dataTypeContent = Aport::findOrFail($id);

        $idCommande = $dataTypeContent->commande_id;
        
        $commande = Commande::with('client','modele','version','Aport')->find($idCommande);

        $users = User::all();
        $commandes = Commande::all();

        return view('vendor.voyager.apports.edit', compact('commande','commandes','users','dataTypeContent'));
    }

    /*------- Update commandes if 24h has passed ------
    public function updatedCommande($commandeID, $ClientID) {
        $commande = Commande::where('id', $commandeID)
            ->where('client_id', $ClientID)
            ->where('created_at', '<=', Carbon::now()->subHours(24))
            ->first();

        if ($commande) {
            // Update the status of the commande
            $commande->update(['Status_commande' => 'délai expiré']);
    
            // Return the updated commande
            return $commande;
        } else {
            return null;
        }
    }
    //------- Update commandes if 24h has passed -------*/

    //------- Update Stock if apport has vaidated ------//
    public function updatedStock($modele, $version, $ClientID){
        // Update the stock status to 'pré-réservation' and retrieve the ID of the updated stock
        $updatedStock = Stock::where('modele_id', $modele->id)
        ->where('version_id', $version->id)
        ->where('client_id', $ClientID)
        ->first();

        if ($updatedStock) {
            // Update the stock status
            $updatedStock->update(['status' => 'réservée']);
            // Retrieve the ID of the updated stock
            $n_chassis = $updatedStock->n_chassis;
        } else {
            // Handle the case where no stock was updated
            return response()->json(['error' => 'No stock available for pré-réservation'], 404);
        }
    }
    //------- Update Stock if apport has vaidated -------//
    
    public function sendIdCommande()
    {
        // Get the authenticated user's ID
        $ClientID = Auth::user()->id;

        // Retrieve commande ID of the client
        $commandeID = Commande::where('client_id', $ClientID)->pluck('id')->first();

        // Get the commande
        $commande = Commande::find($commandeID);
        
        // Retrieve version and equipements of the commande
        $version = $commande?->Version;
        $modele = $commande?->Modele;
        $equipements = $commande?->equipements;

        // Get the creation date of the commande
        $commandeCreationDate = Commande::where('client_id', $ClientID)->pluck('created_at')->first();

        //check if there is a simulation
        $simulateur = Simulateur::where('client_id', $ClientID)->first();

        // Retrieve apport information for the user
        $allapport = Aport::where('client_id', $ClientID)->first();
        
        $isExpired = Commande::where('Status_commande', 'expired')
                    ->where('client_id', $ClientID)
                    ->first();

        // Retrieve apport details for the user
        if ($allapport) {
            // Get all attributes of the apport model
            $apport = $allapport->getAttributes();
            // Retrieve specific attributes from the apport model
            $comptableValidation = $apport['comptable_validation'];
        } else {
            // Handle the case where apport information is not available
            $apport = null;
            $comptableValidation = 0;
        }

        if($comptableValidation){
            $this->updatedStock($modele, $version, $ClientID);
        }
        // Retrieve Dossier Achat details for the user
        $allDossierAchat = DossierAchat::where('client_id', $ClientID)->first();

        if ($allDossierAchat) {
            // Get all attributes of the Dossier Achat model
            $DossierAchat = $allDossierAchat->getAttributes();

            // Retrieve specific attributes from the Dossier Achat model
            $modepaiement_Validation = $DossierAchat['modepaiement_Validation'];
            $cin_Validation = $DossierAchat['cin_Validation'];
            $Attestationsalaire_Validation = $DossierAchat['Attestationsalaire_Validation'];
            $bulletinpaie_Validation = $DossierAchat['bulletinpaie_Validation'];
            $relevebancaire_Validation = $DossierAchat['relevebancaire_Validation'];
            $justificatifdomiciliation_Validation = $DossierAchat['justificatifdomiciliation_Validation'];
            $rib_Validation = $DossierAchat['rib_Validation'];
            $relevecnss_Validation = $DossierAchat['relevecnss_Validation'];
        } else {
            // Handle the case where Dossier Achat information is not available
            $modepaiement_Validation = null;
            $cin_Validation = null;
            $Attestationsalaire_Validation = null;
            $bulletinpaie_Validation = null;
            $relevebancaire_Validation = null;
            $justificatifdomiciliation_Validation = null;
            $rib_Validation = null;
            $relevecnss_Validation = null;
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

        // Pass data to the view
        return view('validerCMD', compact('commandeID','simulateur','isExpired', 'done','allapport', 'equipements', 'version', 'apport', 'comptableValidation', 'commandeCreationDate'));
    }




    public function userStore(Request $request)
    {
        // Get the authenticated user's ID
        $idClient = Auth::user()->id;
        $email = Auth::user()->email;
        $Client = User::find($idClient);

        // Get the commande ID for the authenticated user
        $commande = Commande::where('client_id', $idClient)->first();
        $commandeID = $commande->id;

        $data = $request->validate([
            'nombanque' => 'required|max:50',
            'numerotransaction' => 'required',
            'imagerecu' => 'required|image',  
            'type_paiement' => 'nullable',  
        ]);

        // Handle file upload
        if ($request->hasFile('imagerecu')) {
            $imagePath = $request->file('imagerecu')->store('imagerecu', 'public'); 
            $data['imagerecu'] = $imagePath; 
        }

        $data['client_id'] = $idClient;
        $data['commande_id'] = $commandeID;

        // Send email with the password to the client
        Mail::to($email)->send(new apportMail($Client));
        
        // Create new Aport instance and save data
        $Apport = Aport::create($data);
        
        
        //----    notif commercial & comptable    ----\\ 
            $Commercial = User::where('role_id', 4)->first();
            $Comptable = User::where('role_id', 5)->first();

            if (!$Commercial) {
                throw new \Exception('Commercial user not found.');
            }

            //$CommercialEmail = $Commercial->email;
            //$ComptableEmail = $Comptable->email;
            $CommercialName = $Commercial->name;
            $ComptableName = $Comptable->name;
            $CommercialEmail = "aymaneatirao@gmail.com";
            $ComptableEmail = "kelhadig@gmail.com";

            $idClient = $commande->client_id;
            $idModele = $commande->modele_id;
            $idVersion = $commande->version_id;

            $simulation = Simulateur::where('command_id', $commandeID)->first();

            $financement = $simulation ? 'Crédit' : 'Comptant';

            $user = User::where('id', $idClient)->first();
            $Version = Version::where('id', $idVersion)->first();
            $Modele = Modele::where('id', $idModele)->first();

            if (!$user || !$Version || !$Modele) {
                throw new \Exception('User, Version, or Modele not found.');
            }

            $Montant = '1000';
            $DateCreation = Carbon::parse($Apport->created_at)->format('Y-m-d H:i:s');

            $CommercialemailData = [
                'CommercialName' => $CommercialName,
                'name' => $user->name,
                'prenom' => $user->prenom,
                'nommodele' => $Modele->nommodele,
                'nomversion' => $Version->nomversion,
                'financement' => $financement,
                'Montant' => $Montant,
                'DateCreation' => $DateCreation,
            ];
            $ComptableemailData = [
                'ComptableName' => $ComptableName,
                'name' => $user->name,
                'prenom' => $user->prenom,
                'Montant' => $Montant,
                'DateCreation' => $DateCreation,
            ];
             

            //try {
            //    if ($CommercialEmail) {
            //        Mail::to($CommercialEmail)->send(new reglementApport($CommercialemailData));
            //    }
            //    if($ComptableEmail){
            //        Mail::to($ComptableEmail)->send(new newApport($ComptableemailData));
            //    }
            //} catch (Exception $e) {
                // Log the error or handle it as needed
                // You can choose to ignore the error and continue processing
            //}
        //----    notif commercial & comptable END    ----\\

        return redirect()->back()->with('success', 'Votre aport a bien été envoyé.');
    }


    public function updateSignature(Request $request, $id)
    {
        $validation = $request->validate([
            'signature'=>'nullable|string'
        ]);

        $record = Aport::findOrFail($id);

        $record->update([
            'signature' => $validation['signature']
        ]);

        return redirect()->to('/dossierAchat');

    }


}
