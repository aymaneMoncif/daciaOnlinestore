<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Modele;
use App\Models\Simulateur;
use App\Models\Version;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class PdfController extends Controller
{
    public function showPdf()
    {
        $user = Auth::guard('client')->user();
        $userId = $user->id;
        $commande = Commande::where('client_id', $userId)->first();
        $version_id = $commande->version_id;
        $modele_id = $commande->modele_id;
        $modele = Modele::where('id', $modele_id)->first();
        $version = Version::where('id', $version_id)->first();
        $simulation = Simulateur::where('client_id', $userId)->first();

        $imagePath = public_path('webStyle/assets/logos/logofooter.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        return view('BDC', compact('imageSrc', 'user', 'commande', 'version', 'simulation','modele'));
    }

    public function downloadPdf()
    {
        $user = Auth::guard('client')->user();
        $userId = $user->id;
        $commande = Commande::where('client_id', $userId)->first();
        $version_id = $commande->version_id;
        $modele_id = $commande->modele_id;
        $modele = Modele::where('id', $modele_id)->first();
        $version = Version::where('id', $version_id)->first();
        $simulation = Simulateur::where('client_id', $userId)->first();

        $imagePath = public_path('webStyle/assets/logos/logofooter.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // Create PDF options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Instantiate Dompdf with the options
        $dompdf = new Dompdf($options);
        $htmlContent = view('BDC', compact('imageSrc', 'user', 'commande', 'version', 'simulation','modele'))->render();
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Generate a file name for the PDF
        $filename = 'BDC_' . time() . '.pdf';

        // Output the generated PDF (inline or download)
        return $dompdf->stream($filename);
    }
}
