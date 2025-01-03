<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;
    protected $table = "produtos";
    
    protected $fillable = [
        'idSecao',
        'idUniMedida',
        'nome',
        'descricaoProduto',
        'preco',
        'estoque',
        'produto_destaque',
        'produto_ativo',
    ];

    public function imagens() : HasMany
    {
        return $this->hasMany(Imagens::class, 'idProduto');
    }

    public function secao() : BelongsTo
    {
        return $this->belongsTo(Secao::class, 'idSecao');
    }

    public function unidadeMedida() : BelongsTo
    {
        return $this->belongsTo(UnidadeMedidas::class, 'idUniMedida');
    }

    public function item_venda() : BelongsTo
    {
        return $this->belongsTo(ItensVendas::class, 'id_produto');
    }
}
