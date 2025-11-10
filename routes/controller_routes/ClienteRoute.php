<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteEmailController;
use App\Http\Controllers\ClienteTelefoneController;
use Illuminate\Support\Facades\Route;

Route::apiResource('clientes', ClienteController::class);
Route::prefix('clientes/{cliente}')->group(function () {
    Route::post('telefones', [ClienteTelefoneController::class, 'store']);
    Route::post('emails', [ClienteEmailController::class,'store']);
});