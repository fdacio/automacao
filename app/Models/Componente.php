<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    private $table = 'componente';
    
    private $fillable = ['nome', 'porta', 'sinal'];


}
