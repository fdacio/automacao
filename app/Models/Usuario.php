<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'telefone'];
}
