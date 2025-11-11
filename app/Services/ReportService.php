<?php 

namespace App\Services;

use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportService
{
    public function getClientesWithContatos(array $params)
    {   
        $perPage = $params['per_page'] ?? 15;
        $clientes = Cliente::with('telefones', 'emails', 'contatos.telefones', 'contatos.emails')->paginate($perPage);
        return $clientes;
    }

    public function gerarPdf()
    {
        $clientes = Cliente::with('telefones', 'emails', 'contatos.telefones', 'contatos.emails')->get();

        $pdf = Pdf::loadView('pdf.relatorio_clientes', compact('clientes'));

        return $pdf;
    }
}