<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeMedidas extends Model
{
    use HasFactory;
    protected $table = 'unidade_medidas';
    
    protected $fillable = [
        'unidadeMedida',
        'uni_ativo',
    ];

    public function produtos() : HasMany
    {
        return $this->hasMany(Produto::class, 'idUniMedida');
    }
}
