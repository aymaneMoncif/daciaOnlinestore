<?php

use App\Http\Controllers\ApportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
require __DIR__.'/auth.php';


    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });
    Route::middleware(['auth:admin'])->group(function () {

        Route::patch('/update-all-user/{id}', [ClientController::class, 'updateAllInfo'])->name('update.user.allinfo');

        Route::patch('/dossier-achats/{id}', [DossierAchatController::class, 'update'])->name('update.dossier_achats');

        //update CC & Commercial status&comment
        Route::patch('/commandes/{id}/update', [CommandeController::class, 'updateCustomFields'])->name('custom.commandes.update');
    });



    Route::get('login', [AuthenticatedSessionController::class, 'showUserLoginForm'])->name('login');

    Route::middleware(['auth:client'])->group(function () {

        Route::patch('/update-user/{id}', [ClientController::class, 'update'])->name('update.user');

        Route::get('/SuiviCommande', [DossierAchatController::class, 'sendInfoSuiviCMD'])->name('sendInfoSuiviCMD');

        Route::get('/dossierAchat', [DossierAchatController::class, 'sendInfo'])->name('sendInfoDA');
        Route::post('/dossierAchatstore', [DossierAchatController::class, 'store'])->name('dossierAchat.store');

        Route::get('/livraison', [PaiementController::class, 'sendInfoLivraison'])->name('sendInfoLivraison');

        Route::get('/paiement', [PaiementController::class, 'sendInfoPaiement'])->name('sendInfoPaiement');
        Route::post('/paiementStore', [PaiementController::class, 'userStorePaiement'])->name('paiement.store');

        Route::get('/validationCommande', [ApportController::class, 'sendIdCommande'])->name('sendIdCommande');
        Route::post('/AportStore', [ApportController::class, 'userStore'])->name('aport.store');

        //add signature
        Route::patch('/apport/{id}/update', [ApportController::class, 'updateSignature'])->name('custom.signature.update');
        Route::get('/show-pdf', 'App\Http\Controllers\PdfController@showPdf')->name('show.pdf');
        Route::get('/download-pdf', 'App\Http\Controllers\PdfController@downloadPdf')->name('download.pdf');

        Route::match(['get','post'],'/successURL', [cardPaymentController::class, 'confirmpaie'])->name('confirmpaie');
        Route::match(['get','post'],'/envoimailconfirmation', [cardPaymentController::class, 'envoimailconfirmation'])->name('envoimailconfirmation');
        Route::get('/msgconfirm/{idmsg?}/{email?}', [cardPaymentController::class, 'msgconfirm'])->name('msgconfirm');
        Route::get('/failurl', function () {return view('confirmation.failUrl');});

    });




Route::get('/', function () {
    return view('layout');
});


Route::get('/test', function () {
    return view('test');
});
