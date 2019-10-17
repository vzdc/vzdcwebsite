<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberLog extends Model
{
    protected $table = 'member_logs';
    protected $fillable = ['user_target','user_submitter','content'];

    public function getAuthor() {
        $u = User::find($this->user_submitter);
        if($u != null)
            return $this->hasOne(User::class,'id','user_submitter');
        else
            return null;
    }
}
