<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $fillable = ['id', 'controller_id', 'controller_name', 'controller_email', 'hours', 'visitor', 'month', 'year', 'status', 'updated_at', 'created_at'];

    public function getStatusTextAttribute() {
        if ($this->status == 0) {
            return "Pending";
        }
        else if ($this->status == 1) {
            return "Warned";
        }
        else if ($this->status == 2) {
            return "Warned & 2 hours in first two weeks achieved";
        }
        else if ($this->status == 3) {
            return "Warned and 2 hours in first two weeks not achieved";
        }
        else if ($this->status == 4) {
            return "Warned & 2 hours in first two weeks and 2 more hours in last two weeks achieved";
        }
        else if ($this->status == 5) {
            return "Warned & 2 hours in first two weeks and 2 more hours in last two weeks not achieved";
        }
    }
}

// Statuses:
// 0 -> pending
// 1 -> warned
// 2 -> warned & 2 hours in first two weeks achived
// 3 -> warned and 2 hours in first two weeks not achieved
// 4 -> warned & 2 hours in first two weeks and 2 more hours in last 2 weeks achieved
// 5 -> warned & 2 hours in first two weeks and 2 more hours in last 2 weeks not achieved 