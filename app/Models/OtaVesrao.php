<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table='devices';
    protected $fillable = ['nome', 'slug', 'descricao'];
}