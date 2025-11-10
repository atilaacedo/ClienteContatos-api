<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('emails')->controller(EmailController::class)->group(function () {
    Route::delete('/{email}', 'destroy');
});