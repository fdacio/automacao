<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
    protected $table = 'presenca';

    protected $fillable = ['temperatura', 'humidade'];
}
