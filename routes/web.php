<?php

use App\Http\Controllers\ApportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DossierAchatController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\cardpay\cardPaymentController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return ['Laravel' => app()->version()];
});*/

Route::middleware(['auth'])->group(function () {

    Route::get('/SuiviCommande', [DossierAchatController::class, 'sendInfoSuiviCMD'])->name('sendInfoSuiviCMD');

    Route::get('/dossierAchat', [DossierAchatController::class, 'sendInfo'])->name('sendInfoDA');
    Route::post('/dossierAchatstore', [DossierAchatController::class, 'store'])->name('dossierAchat.store');
    Route::patch('/dossier-achats/{id}', [DossierAchatController::class, 'update'])->name('update.dossier_achats');

    Route::get('/livraison', [PaiementController::class, 'sendInfoLivraison'])->name('sendInfoLivraison');

    Route::get('/paiement', [PaiementController::class, 'sendInfoPaiement'])->name('sendInfoPaiement');
    Route::post('/paiementStore', [PaiementController::class, 'userStorePaiement'])->name('paiement.store');

    Route::get('/validationCommande', [ApportController::class, 'sendIdCommande'])->name('sendIdCommande');
    Route::post('/AportStore', [ApportController::class, 'userStore'])->name('aport.store');

    Route::patch('/update-user/{id}', [ClientController::class, 'update'])->name('update.user');

    //update CC & Commercial status&comment
    Route::patch('/commandes/{id}/update', [CommandeController::class, 'updateCustomFields'])->name('custom.commandes.update');

    //add signature
    Route::patch('/apport/{id}/update', [ApportController::class, 'updateSignature'])->name('custom.signature.update');

    Route::match(['get','post'],'/successURL', [cardPaymentController::class, 'confirmpaie'])->name('confirmpaie');
    Route::match(['get','post'],'/envoimailconfirmation', [cardPaymentController::class, 'envoimailconfirmation'])->name('envoimailconfirmation');
    Route::get('/msgconfirm/{idmsg?}/{email?}', [cardPaymentController::class, 'msgconfirm'])->name('msgconfirm');

});





Route::get('/show-pdf', 'App\Http\Controllers\PdfController@showPdf')->name('show.pdf');
Route::get('/download-pdf', 'App\Http\Controllers\PdfController@downloadPdf')->name('download.pdf');

Route::get('/', function () {
    return view('layout');
});


Route::get('/test', function () {
    return view('test');
});




Route::get('/failURL', function () {
    return view('test');
});

//Route::get('/msgconfirm', function () {
//    return view('confirmation/msgconfirm');
//});



require __DIR__.'/auth.php';


Route::group(['prefix' => 'page'], function () {
    Voyager::routes();
});
