<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Loa extends Model
{
    protected $table = 'loas';
    protected $fillable = ['id', 'controller_id', 'controller_name', 'end_date', 'reason', 'status', 'updated_at', 'created_at'];
}

