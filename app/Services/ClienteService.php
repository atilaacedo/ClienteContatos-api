<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteService
{


    public function createCliente(array $data)
    {
        try {
            DB::beginTransaction();

            $dataCliente = array_filter($data, function ($key) {
                return in_array($key, ['nome_completo']);
            }, ARRAY_FILTER_USE_KEY);

            $cliente = Cliente::create($dataCliente);

            if (isset($data['telefones']) && is_array($data['telefones'])) {
                foreach ($data['telefones'] as $telefone) {
                    $cliente->telefones()->create([
                        'numero' => $telefone,
                        'telefoneable_id' => $cliente['id'],
                        'telefoneable_type' => Cliente::class,
                    ]);
                }
            }

            if (isset($data['emails']) && is_array($data['emails'])) {
                foreach ($data['emails'] as $email) {
                    $cliente->emails()->create([
                        'email' => $email,
                        'emailable_id' => $cliente['id'],
                        'emailable_type' => Cliente::class,
                    ]);
                }
            }


            DB::commit();

            return $cliente->load('telefones', 'emails');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Erro ao cadastrar cliente: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $cliente = Cliente::with('telefones', 'emails')->get();

        return $cliente;
    }
    public function update(Cliente $cliente, array $data)
    {
        try {
            $cliente->update($data);

            return $cliente;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }

    public function delete(Cliente $cliente)
    {
        try {
            DB::beginTransaction();
            $cliente->telefones()->delete();
            $cliente->emails()->delete();
            $cliente->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Erro ao deletar cliente: " . $e->getMessage());
        }
    }
}
