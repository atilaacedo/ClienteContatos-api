<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    public function destroy(Telefone $telefone)
    {
        $telefone->delete();
        return response()->noContent();
    }
}
