<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendas extends Model
{
    use HasFactory;

    protected $table = "vendas";
    
    protected $fillable = [
        'id_cliente',
        'id_pagamento_mercado_pago',
        'tipo_pagamento',
        'total_venda',
        'status',
    ];

    public function itens() : HasMany
    {
        return $this->hasMany(ItensVendas::class, 'id_venda');
    }
}
