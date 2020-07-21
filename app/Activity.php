<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $fillable = ['id', 'controller_id', 'controller_name', 'controller_email', 'visitor', 'month', 'year', 'status', 'updated_at', 'created_at'];
}

// Statuses:
// 0 -> warned
// 1 -> warned & 2 hours in first two weeks achived
// 2 -> warned and 2 hours in first two weeks not achieved
// 3 -> warned & 2 hours in first two weeks and 2 more hours in last 2 weeks achieved
// 4 -> warned & 2 hours in first two weeks and 2 more hours in last 2 weeks not achieved 