<?php

namespace Automacao\Models;

use Illuminate\Database\Eloquent\Model;

class Temperatura extends Model
{
    protected $table = 'temperaturas';

    protected $fillable = ['temperatura', 'humidade'];
}
