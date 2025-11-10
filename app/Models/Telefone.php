<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'numero',
        'telefoneable_id',
        'telefoneable_type',
    ];


    public function telefoneable()
    {
        return $this->morphTo();
    }
}
