<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResource;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function __construct(private ReportService $reportService){}

    public function getClientesWithContatos(Request $request)
    {
        $queryParams = $request->validate([
            'per_page' => 'sometimes|integer|min:1|max:100',
            'page' => 'sometimes|integer|min:1'
        ]);
        $clientes = $this->reportService->getClientesWithContatos($queryParams);
        return ClienteResource::collection($clientes);
    }
}
