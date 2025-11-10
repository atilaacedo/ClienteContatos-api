<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContatoRequest;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\StoreTelefoneRequest;
use App\Http\Requests\UpdateContatoRequest;
use App\Http\Resources\ContatoResource;
use App\Models\Contato;
use App\Services\ContatoService;
use Illuminate\Http\Request;

class ContatoController extends Controller
{

    public function __construct(private ContatoService $contatoService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contatos = $this->contatoService->getAllContatos();
        return response()->json(ContatoResource::collection($contatos), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContatoRequest $request)
    {
        $data = $request->validated();
        $contato = $this->contatoService->createContato($data);

        return response()->json(new ContatoResource($contato), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contato $contato)
    {
        $contato = $this->contatoService->getContato($contato);
        return response()->json(new ContatoResource($contato), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContatoRequest $request, Contato $contato)
    {
        $data = $request->validated();
        $contato = $this->contatoService->updateContato($contato, $data);

        return response()->json(new ContatoResource($contato), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contato $contato)
    {
        $this->contatoService->deleteContato($contato);

        return response()->noContent();
    }

    public function attachEmail(StoreEmailRequest $request, Contato $contato)
    {
        $email = $contato->emails()->create($request->validated());

        return response()->json($email, 201);
    }

    public function attachTelefone(StoreTelefoneRequest $request, Contato $contato)
    {
        $telefone = $contato->telefones()->create($request->validated());

        return response()->json($telefone, 201);
    }
}
