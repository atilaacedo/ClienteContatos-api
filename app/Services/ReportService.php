<?php 

namespace App\Services;

use App\Models\Cliente;

class ReportService
{
    public function getClientesWithContatos(array $params)
    {   
        $perPage = $params['per_page'] ?? 15;
        $clientes = Cliente::with('telefones', 'emails', 'contatos.telefones', 'contatos.emails')
        ->paginate($perPage);
        return $clientes;
    }
}