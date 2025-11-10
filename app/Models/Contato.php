<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contato extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'cliente_id',
        'nome_completo'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function telefones()
    {
        return $this->morphMany(Telefone::class, 'telefonable');
    }
}
