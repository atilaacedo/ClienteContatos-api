<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContatoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome_completo' => $this->nome_completo,
            'emails'        => $this->whenLoaded('emails', $this->emails->pluck('email')),
            'telefones'     => $this->whenLoaded('telefones', $this->telefones->pluck('numero')),
        ];
    }
}
