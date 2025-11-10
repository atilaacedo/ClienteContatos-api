<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelefoneRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteTelefoneController extends Controller
{
    
    public function store(StoreTelefoneRequest $request, Cliente $cliente)
    {
        $data = $request->validated();

        $telefones = $cliente->telefones()->createMany(
            array_map(fn($numero) => ['numero' => $numero], $data['telefones'])
        );
        
        return response()->json($telefones, 201);
    }
}
