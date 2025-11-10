<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteEmailController;
use App\Http\Controllers\ClienteTelefoneController;
use Illuminate\Support\Facades\Route;

Route::apiResource('clientes', ClienteController::class);
Route::prefix('clientes/{cliente}')->controller(ClienteController::class)->group(function () {
    Route::post('telefones', 'attachTelefone');
    Route::post('emails', 'attachEmail');
});