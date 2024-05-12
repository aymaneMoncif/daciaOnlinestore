<?php

use App\Http\Controllers\cardpay\cardPaymentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CsrfTokenController;
use App\Http\Controllers\guestController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\VersionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum,client'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/modeles', ModeleController::class);

Route::post('/store-guest',  [guestController::class, 'StoreGuest'])->name('store.guest');
Route::post('/update-guest', [guestController::class, 'UpdateGuest'])->name('update.guest');

Route::get('/csrf-token', [CsrfTokenController::class, 'getCsrfToken']);

Route::apiResource('/versions', VersionController::class);

Route::apiResource('/client', ClientController::class);

Route::apiResource('/Commande', CommandeController::class);

Route::post('/simulateur', [CommandeController::class, 'StoreSimulateur'])->name('store.simulateur');



/*Route::get('/user-id', function () {
    $userId = auth()->id();
    return response()->json(['userId' => $userId]);
})->middleware('auth:api');*/

/*Route::apiResource([
    'modeles' => ModeleController::class,
]);*/
