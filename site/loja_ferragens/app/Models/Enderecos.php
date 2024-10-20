<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enderecos extends Model
{
    use HasFactory;
    protected $table = "enderecos";

    protected $fillable = [
        'id_cliente',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
    ];

    public function clientes() : BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
}
