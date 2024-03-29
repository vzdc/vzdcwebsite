<?php

namespace App;

use App\MemberLog;
use Carbon\Carbon;
use App\CotrollerLog;
use App\SoloCert;
use App\TrainingTicket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;

    protected $table = 'roster';
    protected $fillable = ['access_token', 'refresh_token','token_expires', 'id', 'fname', 'lname', 'email', 'rating_id', 'canTrain', 'visitor', 'status', 'loa', 'delgnd', 'twr', 'chp', 'mtv', 'shd', 'app', 'ctr', 'train_pwr', 'monitor_pwr', 'opt', 'initials', 'added_to_facility'];
    protected $secret = ['remember_token', 'password', 'json_token'];
    protected $hidden = [
        'access_token',
        'refresh_token',
        'token_expires',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBackwardsNameAttribute()
    {
        return $this->lname . ', ' . $this->fname;
    }

    public function GetBackwardsNameWithCidAttribute() {
        return $this->lname . ', ' . $this->fname . ' (' . $this->id . ')';
    }

    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function getTokenAttribute()
    {
        if ($this->access_token === null) return null;
        else {
            $token = new AccessToken([
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'expires' => $this->token_expires,
            ]);

            if ($token->hasExpired()) {
                $token = VatsimOAuthController::updateToken($token);
            }

            // Can't put it inside the "if token expired"; $this is null there
            // but anyway Laravel will only update if any changes have been made.
            $this->update([
                'access_token' => ($token) ? $token->getToken() : null,
                'refresh_token' => ($token) ? $token->getRefreshToken() : null,
                'token_expires' => ($token) ? $token->getExpires() : null,
            ]);

            return $token;
        }
    }

    public static $RatingShort = [
        0 => 'N/A',
        1 => 'OBS', 2 => 'S1',
        3 => 'S2', 4 => 'S3',
        5 => 'C1', 7 => 'C3',
        8 => 'I1', 10 => 'I3',
        11 => 'SUP', 12 => 'ADM',
    ];

    public function getRatingShortAttribute()
    {
        foreach (User::$RatingShort as $id => $Short) {
            if ($this->rating_id == $id) {
                return $Short;
            }
        }

        return "";
    }

    public function getRatingLongAttribute()
    {
        foreach (User::$RatingLong as $id => $Short) {
            if ($this->rating_id == $id) {
                return $Short;
            }
        }

        return "";
    }

    public static $RatingLong = [
        0 => 'Pilot',
        1 => 'Observer (OBS)', 2 => 'Student 1 (S1)',
        3 => 'Student 2 (S2)', 4 => 'Senior Student (S3)',
        5 => 'Controller (C1)', 7 => 'Senior Controller (C3)',
        8 => 'Instructor (I1)', 10 => 'Senior Instructor (I3)',
        11 => 'Supervisor (SUP)', 12 => 'Admin (ADM)',
    ];

    public static $StatusText = [
        0 => 'LOA',
        1 => 'Active'
    ];

    public function getStatusTextAttribute()
    {
        foreach (User::$StatusText as $id => $Status) {
            if ($this->status == $id) {
                return $Status;
            }
        }

        return "";
    }

    public function getStaffPositionAttribute()
    {
        if ($this->hasRole('atm')) {
            return 1;
        } elseif ($this->hasRole('datm')) {
            return 2;
        } elseif ($this->hasRole('ta')) {
            return 3;
        } elseif ($this->hasRole('ata')) {
            return 4;
        } elseif ($this->hasRole('wm')) {
            return 5;
        } elseif ($this->hasRole('awm')) {
            return 6;
        } elseif ($this->hasRole('fe')) {
            return 7;
        } elseif ($this->hasRole('afe')) {
            return 8;
        } elseif ($this->hasRole('ec')) {
            return 9;
        } elseif ($this->hasRole('aec')) {
            return 10;
        } else {
            return 0;
        }
    }

    public function getTrainPositionAttribute()
    {
        if ($this->hasRole('mtr')) {
            return 1;
        } elseif ($this->hasrole('ins')) {
            return 2;
        } else {
            return 0;
        }
    }

    public function getLastTrainingAttribute()
    {
        $tickets_sort = TrainingTicket::where('controller_id', $this->id)->get()->sortByDesc(function ($t) {
            return strtotime($t->date . ' ' . $t->start_time);
        })->pluck('id');
        if ($tickets_sort->count() != 0) {
            $tickets_order = implode(',', array_fill(0, count($tickets_sort), '?'));
            $last_training = TrainingTicket::whereIn('id', $tickets_sort)->where('no_show', null)->orderByRaw("field(id,{$tickets_order})", $tickets_sort)->first();
        } else {
            $last_training = null;
        }

        if ($last_training != null) {
            return $last_training->date;
        } else {
            return null;
        }
    }

    public function getLastTrainingGivenAttribute()
    {
        $tickets_sort = TrainingTicket::where('trainer_id', $this->id)->get()->sortByDesc(function ($t) {
            return strtotime($t->date . ' ' . $t->start_time);
        })->pluck('id');
        if ($tickets_sort->count() != 0) {
            $tickets_order = implode(',', array_fill(0, count($tickets_sort), '?'));
            $last_training_given = TrainingTicket::whereIn('id', $tickets_sort)->orderByRaw("field(id,{$tickets_order})", $tickets_sort)->first();
            $last_training_given = $last_training_given;
        } else {
            $last_training_given = null;
        }

        if ($last_training_given != null) {
            return $last_training_given->date;
        } else {
            return null;
        }
    }

    public function getSoloAttribute()
    {
        $cert = SoloCert::where('cid', $this->id)->where('status', 0)->first();
        if ($cert)
            $date = Carbon::parse($cert->expiration)->format('m/d/Y');
        else
            $date = 'N/A';
        return $date;
    }

    public function getLogs()
    {
        $logs = MemberLog::where('user_target', $this->id)->orderBy('created_at', 'DESC')->get();
        if (count($logs) > 0)
            return $logs;
        else
            return null;
    }
}


