<?php

namespace App;

use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use SimpleXMLElement;

class TrainingTicket extends Model
{
    protected $table = 'training_tickets';
    protected $fillable = ['id', 'controller_id', 'trainer_id', 'position', 'no_show', 'type', 'date', 'start_time', 'end_time', 
                            'duration', 'comments', 'ins_comments', 'score', 'updated_at', 'created_at'];

    public function getTrainerNameAttribute()
    {
        if ($this->trainer_id == 0) {
            $name = 'N/A';
        } else {
            $user = User::find($this->trainer_id);
            if ($user != null) {
                $name = $user->full_name;
            } else {
                $client = new Client();
                $response = $client->request('GET', 'https://cert.vatsim.net/vatsimnet/idstatus.php?cid=' . $this->trainer_id);
                $r = new SimpleXMLElement($response->getBody());
                $name = $r->user->name_first . ' ' . $r->user->name_last;
            }
        }

        return $name;
    }

    public function getControllerNameAttribute()
    {
        $name = User::find($this->controller_id)->full_name;

        return $name;
    }

    public function getTypeNameAttribute()
    {
        $pos = $this->type;
        if ($pos == 0) {
            $position = 'Classroom Training';
        } elseif ($pos == 1) {
            $position = 'Sweatbox Training';
        } elseif ($pos == 2) {
            $position = 'Live Training';
        } elseif ($pos == 3) {
            $position = 'Live Monitoring';
        } elseif ($pos == 4) {
            $position = 'Sweatbox OTS (Pass)';
        } elseif ($pos == 5) {
            $position = 'Live OTS (Pass)';
        } elseif ($pos == 6) {
            $position = 'Sweatbox OTS (Fail)';
        } elseif ($pos == 7) {
            $position = 'Live OTS (Fail)';
        } elseif ($pos == 8) {
            $position = 'OTS';
        } elseif ($pos == 9) {
            $position = 'N/A';
        }
        return $position;
    }

    public function getPositionNameAttribute()
    {
        $pos = $this->position;
        if ($pos == 0) {
            $position = 'Minor Delivery/Ground';
        } elseif ($pos == 1) {
            $position = 'Minor Local';
        } elseif ($pos == 2) {
            $position = 'Major Delivery/Ground';
        } elseif ($pos == 3) {
            $position = 'Major Local';
        } elseif ($pos == 4) {
            $position = 'Minor Approach';
        } elseif ($pos == 5) {
            $position = 'Major Approach';
        } elseif ($pos == 6) {
            $position = 'Center';
        }
        return $position;
    }

    public function getFacilityNameAttribute()
    {
        $fac = $this->facility;
        if ($fac == 0) {
            $facility = 'KIAD';
        } elseif ($fac == 1) {
            $facility = 'KBWI';
        } elseif ($fac == 2) {
            $facility = 'KDCA';
        } elseif ($fac == 3) {
            $facility = 'KORF';
        } elseif ($fac == 4) {
            $facility = 'DC';
        }

        return $facility;
    }

    public function getDateEditAttribute()
    {
        $date = new Carbon($this->date);
        $date = $date->format('Y-m-d');
        return $date;
    }

    public function getDateSortAttribute()
    {
        $date = strtodate($this->date . ' ' . $this->time);
        return $date;
    }

    public function getNoShowTextAttribute()
    {
        if ($this->no_show == 1) {
            return 'Yes';
        } else {
            return 'No';
        }
    }

    // Function to get position name for centralized training
    public function getPositionCentralAttribute() {
        // Get position id
        $position = $this->position;

        // Get facility name string
        $facility = $this->facility_name;

        // Check each position and return string
        switch ($position) {
            case 0:
                return $facility . "_" . "GND";
            case 1:
                return $facility . "_" . "TWR";
            case 2:
                return $facility . "_" . "GND";
            case 3:
                return $facility . "_" . "TWR";
            case 4:
                return $facility . "_" . "APP";
            case 5:
                return $facility . "_" . "APP";
            case 6:
                return $facility . "_" . "CTR";
            default:
                return null;
        }
    }

    // Function to get type for centralized training
    public function getTypeCentralAttribute() {
        switch($this->type) {
            case 0:
                return 0;
            case 1:
                return 2;
            case 2:
                return 1;
            case 3:
                return 1;
            case 4:
                return 2;
            case 5:
                return 1;
            case 6:
                return 2;
            case 7:
                return 1;
            case 8:
                return 2;
            case 9:
                return 0;
            default:
                return 0;
        }
    }
}
