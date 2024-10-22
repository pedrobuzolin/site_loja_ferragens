<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItensVendas extends Model
{
    use HasFactory;

    protected $table = "itens_vendas";
    
    protected $fillable = [
        'id_venda',
        'id_produto',
        'valor_produto',
        'quantidade',
    ];

    public function vendas() : BelongsTo
    {
        return $this->belongsTo(Vendas::class, 'id_venda');
    }

    public function produtos() : BelongsTo
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
