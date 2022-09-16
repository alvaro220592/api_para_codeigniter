<?php

use App\Http\Controllers\Api\v1\BoletoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ParcelasController;
use App\Http\Controllers\Api\v1\RegistrosWebserviceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    Route::resource('parcelas', ParcelasController::class)->middleware('apiHeaders');
    Route::resource('registrosWebservice', RegistrosWebserviceController::class)->middleware('apiHeaders');

    Route::post('parcelas/conciliacao', [ParcelasController::class, 'conciliar'])->middleware('apiHeaders');

    Route::resource('boleto', BoletoController::class);
});