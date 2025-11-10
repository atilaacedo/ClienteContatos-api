<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function __construct(private ClienteService $clienteService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = $this->clienteService->getAll();

        return ClienteResource::collection($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $data = $request->validated();
        $cliente = $this->clienteService->createCliente($data);
        return response()->json(new ClienteResource($cliente), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente->load('telefones', 'emails');
        return new ClienteResource($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $data = $request->validated();
        $updatedCliente = $this->clienteService->update($cliente, $data);
        return new ClienteResource($updatedCliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $this->clienteService->delete($cliente);
        return response()->noContent();
    }
}
