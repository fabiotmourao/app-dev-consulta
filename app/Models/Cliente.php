<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'razao_social', 'cnpj'];

    public function selecoes()
    {
        return $this->hasMany(Selecao::class);
    }
}
