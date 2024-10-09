<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secao extends Model
{
    use HasFactory;
    protected $table = "secao";
    
    protected $fillable = [
        'nomeSecao',
    ];

    public function produtos() : HasMany
    {
        return $this->hasMany(Produto::class, 'idSecao');
    }
}
