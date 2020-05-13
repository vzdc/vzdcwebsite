<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variables';
    protected $fillable = ['id', 'name', 'value'];
}
