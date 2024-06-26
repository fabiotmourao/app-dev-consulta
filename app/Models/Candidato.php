<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'cpf', 'logradouro'];

    public function selecoes()
    {
        return $this->hasMany(Selecao::class);
    }
}
