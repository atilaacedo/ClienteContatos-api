<?php

use App\Http\Controllers\TelefoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('telefones')->controller(TelefoneController::class)->group(function () {
    Route::delete('/{telefone', 'destroy');
});