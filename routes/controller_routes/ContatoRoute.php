<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ContatoTelefoneController;
use Illuminate\Support\Facades\Route;

Route::apiResource('contatos', ContatoController::class);

Route::prefix('contatos/{contato}')->group(function () {
    Route::post('telefones', [ContatoTelefoneController::class, 'store']);
    ROute::post('emails', [ContatoTelefoneController::class, 'storeEmail']);
});