<?php

namespace App\Http\Controllers;

use App\Models\ImageInterieur;
use App\Models\ImagesThreeSixty;
use App\Models\Stock;
use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        // Fetch the version details
        $version = Version::findOrFail($id);

        $Equipements = $version->Equipements;
        // Fetch the colors associated with this version that are in stock
        $colors = $version->couleurs->filter(function ($color) use ($version) {
            return Stock::where('id_couleur', $color->id)
                ->where('version_id', $version->id)
                ->where('status', null)
                ->exists();
        });

        foreach ($colors as $color) {
            // Replace backslashes with forward slashes in each color's imagecouleur field
            $color->imagecouleur = str_replace(['\\','//', '\/'], '/', $color->imagecouleur);
            $color->imagecouleur = asset('storage/'.$color->imagecouleur);
        }

        // Fetch the images associated with this version and colors
        $images = ImagesThreeSixty::where('version_id', $id)->get();
        $imagesInterieur = ImageInterieur::where('version_id', $id)->get();

        return response()->json([
            'version' => $version,
            'stockColors' => $colors->values()->all(),
            'images' => $images,
            'imagesInterieur' => $imagesInterieur,
        ]);
    }



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
