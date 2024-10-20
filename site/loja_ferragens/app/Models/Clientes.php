<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clientes extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'id_user',
        'nome_cliente',
        'cpf',
        'celular',
    ];

    public function endereco() : HasOne
    {
        return $this->hasOne(Enderecos::class, 'id_cliente');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
