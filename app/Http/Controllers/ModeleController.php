<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Modele;
use App\Models\Stock;
use App\Models\Version;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = DB::table('stocks')
        ->select('modeles.*')
        ->join('modeles', 'stocks.modele_id', '=', 'modeles.id')
        ->distinct('modeles.id')
        ->where('status', null)
        ->get();

        $stocks->each(function ($modele) {
            $imageFilename = str_replace('\\', '/', $modele->imagemodele);
            $modele->image_url = asset('storage/' . $imageFilename);
        });
        
        return response()->json($stocks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
    * * * * * * * * * * * * * * * * * * ** * * *  * * * 
    * this function shows the versions of an modele *
    * * * * * * * * * * * * * * * * * * * * * * * * * */ 
    public function show($id)
    {
        $modele = Modele::findOrFail($id);

        // Fetch versions associated with the given modele through stocks
        $availableVersions = DB::table('stocks')
            ->select('versions.*')
            ->join('versions', 'stocks.version_id', '=', 'versions.id')
            ->whereNull('stocks.status')
            ->where('stocks.modele_id', $modele->id)
            ->distinct()
            ->get();



        // Retrieve equipements and prices for each version
        foreach ($availableVersions as $stockVersion) {
            $versionId = $stockVersion->id;
            $stockVersion->equipements = Equipement::select('equipements.id', 'equipements.nomequipement', 'equipements.imageequipement', 'prix_equipements.prix')
                ->join('prix_equipements', 'equipements.id', '=', 'prix_equipements.equipement_id')
                ->where('prix_equipements.version_id', $versionId)
                ->get();
        }

        return response()->json([
            'versions' => $availableVersions,
            'modele' => $modele,
        ]);
    }


    /*
    * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
    */ 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
