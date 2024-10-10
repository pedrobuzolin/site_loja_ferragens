<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    use HasFactory;
    protected $table = 'imagem_produto';

    protected $fillable = [
        'idProduto',
        'urlImagem',
    ];

    public function produto() : BelongsTo
    {
        return $this->belongsTo(Produto::class, 'idProduto');
    }
}
