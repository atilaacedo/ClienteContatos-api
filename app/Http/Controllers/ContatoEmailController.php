<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoEmailController extends Controller
{
    public function store(StoreEmailRequest $request, Contato $contato)
    {
        $data = $request->validated();

        $emails = $contato->emails()->createMany(
            array_map(fn($email) => ['email' => $email], $data['emails'])
        );
        
        return response()->json($emails, 201);
    }
}
