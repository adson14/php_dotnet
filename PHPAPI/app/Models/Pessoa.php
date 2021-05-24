<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'pessoaId','nome', 'sobrenome', 'idade','profissao',
    ];

    protected $primaryKey = 'pessoaId';
}
