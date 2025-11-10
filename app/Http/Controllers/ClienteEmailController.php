<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteEmailController extends Controller
{
    

    public function store(StoreEmailRequest $request, Cliente $cliente)
    {
        $data = $request->validated();

        $emails = $cliente->emails()->createMany(
            array_map(fn($email) => ['email' => $email], $data['emails'])
        );
        
        return response()->json($emails, 201);
    }
}
