<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nome_completo'
    ];

    public function contatos()
    {
        return $this->hasMany(Contato::class);
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
