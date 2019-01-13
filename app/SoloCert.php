<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoloCert extends Model
{
    protected $table = 'solo_certs';
    protected $fillable = ['id', 'controller_id', 'position', 'value', 'created_at', 'updated_at'];
}
