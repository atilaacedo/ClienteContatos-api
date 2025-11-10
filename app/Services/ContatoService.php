<?php

namespace App\Services;

use App\Models\Contato;
use Illuminate\Support\Facades\DB;

class ContatoService
{


    public function createContato(array $data) {
        try{
            DB::beginTransaction();

            $dataContato = array_filter($data, function ($key) {
                return in_array($key, ['nome_completo', 'cliente_id']);
            }, ARRAY_FILTER_USE_KEY);

            $contato = Contato::create($dataContato);

            if (isset($data['telefones']) && is_array($data['telefones'])) {
                foreach ($data['telefones'] as $telefone) {
                    $contato->telefones()->create([
                        'numero' => $telefone,
                        'telefoneable_id' => $contato['id'],
                        'telefoneable_type' => Contato::class,
                    ]);
                }
            }

            if (isset($data['emails']) && is_array($data['emails'])) {
                foreach ($data['emails'] as $email) {
                    $contato->emails()->create([
                        'email' => $email,
                        'emailable_id' => $contato['id'],
                        'emailable_type' => Contato::class,
                    ]);
                }
            }


            DB::commit();

            return $contato->load('telefones', 'emails');
        }catch(\Exception $e){
            DB::rollback();
            throw new \Exception("Erro ao cadastrar contato: " . $e->getMessage());
        }
    }

    public function getAllContatos(){
        $contatos = Contato::with('telefones', 'emails', 'cliente')->get();
        return $contatos;
    }
    public function getContato(Contato $contato){
        return $contato->load('telefones', 'emails', 'cliente');

    }
    public function getById(string $id){
        $contato = Contato::with('telefones', 'emails')->findOrFail($id);
        return $contato;
    }

    public function updateContato(Contato $contato, array $data)
    {
        try{
            $contato->update($data);

            return $contato;
        }catch(\Exception $e){
            throw new \Exception("Erro ao atualizar contato: " . $e->getMessage());
        }
    }

    public function deleteContato(Contato $contato)
    {
        try{
            $contato->telefones()->delete();
            $contato->emails()->delete();
            $contato->delete();

            return true;
        }catch(\Exception $e){
            throw new \Exception("Erro ao deletar contato: " . $e->getMessage());
        }
    }
}
