<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ContatoTelefoneController;
use Illuminate\Support\Facades\Route;

Route::apiResource('contatos', ContatoController::class);

Route::prefix('contatos/{contato}')->controller(ContatoController::class)->group(function () {
    Route::post('telefones', 'attachTelefone');
    ROute::post('emails', 'attachEmail');
});