<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Selecao extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'cliente_id', 'candidato_id'];

    protected $table = 'selecoes';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
}
