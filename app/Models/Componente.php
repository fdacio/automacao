<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $table = 'componentes';
    
    protected $fillable = ['nome', 'pino', 'sinal'];


}
