<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $table = 'componentes';
    
    protected $fillable = ['nome', 'pino', 'sinal', 'cor'];


    public const PINOS = [
            2 => 'Pino 2', 
            3 => 'Pino 3', 
            4 => 'Pino 4', 
            5 => 'Pino 5', 
            6 => 'Pino 6',
            7 => 'Pino 7',
            8 => 'Pino 8',
            9 => 'Pino 9',
            10 => 'Pino 10',
            11 => 'Pino 11',
            12 => 'Pino 12',
            13 => 'Pino 13',
    ];

    public const CORES = [
        '#FF0000' => 'Vermelho',
        '#FFCC00' => 'Amarelo',
        '#00FF00' => 'Verde',
        '#0000FF' => 'Azul',
        '#993300' => 'Marron',
        '#000000' => 'Preto'
    ];

    public function getComponentePinoAttribute()
    {
        return self::PINOS[$this->attributes['pino']];
    }

    public function getComponenteCorAttribute()
    {
        if (isset($this->attributes['cor'])) {
            return self::CORES[$this->attributes['cor']];
        }
    }
}
