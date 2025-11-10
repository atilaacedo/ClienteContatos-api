<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelefoneRequest;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoTelefoneController extends Controller
{
        public function store(StoreTelefoneRequest $request, Contato $contato)
    {
        $data = $request->validated();

        $telefones = $contato->telefones()->createMany(
            array_map(fn($numero) => ['numero' => $numero], $data['telefones'])
        );
        
        return response()->json($telefones, 201);
    }
}
