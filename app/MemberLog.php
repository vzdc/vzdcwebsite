<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberLog extends Model
{
    protected $table = 'member_logs';
    protected $fillable = ['user_target', 'user_submitter', 'content', 'confidential'];

    public function getAuthor()
    {
        $u = User::find($this->user_submitter);
        if ($u != null) {
            return $u->getFullNameAttribute();
        }
        else if ($this->user_submitter == 0) {
            return "ADMIN";
        }
        else {
            return null;
        }
    }
}
