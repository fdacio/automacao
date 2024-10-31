<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table='device';
    protected $fillable = ['nome', 'slug'];
}