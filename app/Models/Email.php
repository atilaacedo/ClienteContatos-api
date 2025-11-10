<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'emailable_id',
        'emailable_type',
        'email'
    ];

    public function emailable()
    {
        return $this->morphTo();
    }
}
