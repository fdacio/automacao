<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Informacao extends Model
{
    protected $table = 'informacoes';
    
    protected $fillable = ['texto'];
}
