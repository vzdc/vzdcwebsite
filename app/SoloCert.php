<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SoloCert extends Model
{
    protected $table = 'solo_certs';
    protected $fillable = ['id', 'controller_id', 'position', 'value', 'created_at', 'updated_at'];

    public function getExpirationDateAttribute() {
        $date = $this->created_at->addMonth();
        $display = $date->format('m/d/Y');

        return $display;
    }
}
