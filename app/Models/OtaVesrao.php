<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table='devices';
    protected $fillable = ['nome', 'slug', 'descricao'];
}