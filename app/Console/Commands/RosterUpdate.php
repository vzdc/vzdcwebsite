<?php

namespace App\Console\Commands;

use App\EventRegistration;
use App\User;
use App\MemberLog;
use Config;
use Eloquent\Collection;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent;
use Illuminate\Http\Request;

class RosterUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RosterUpdate:UpdateRoster';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the roster against the VATUSA roster.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $res = $client->get('https://api.vatusa.net/v2/facility/' . Config::get('vatusa.facility') . '/roster?apikey=' . Config::get('vatusa.api_key'));
        $roster = json_decode($res->getBody())->data;
        $users = User::where('status', '1')->get()->pluck('id');

        foreach ($roster as $r) {
            if (User::find($r->cid) !== null) {
                $user = User::find($r->cid);
                $user->fname = $r->fname;
                $user->lname = $r->lname;
                $user->initials = $this->getInitials($user->fname, $user->lname);
                $user->email = $r->email;
                $user->rating_id = $r->rating;
                $user->visitor = !$r->flag_homecontroller;
                if ($user->visitor) {
                    $user->visitor_from = $user->facility;
                }
                $user->added_to_facility = substr($r->facility_join, 0, 10) . ' ' . substr($r->facility_join, 11, 8);
                if ($user->status == 2) {
                    $user->status = 1;
                }
                $user->save();
            } else {
                $user = new User;
                $user->id = $r->cid;
                $user->fname = $r->fname;
                $user->lname = $r->lname;
                $user->email = $r->email;
                $user->rating_id = $r->rating;
                $user->visitor = !$r->flag_homecontroller;
                if ($user->visitor) {
                    $user->visitor_from = $user->facility;
                }
                $user->status = '1';
                $user->added_to_facility = substr($r->facility_join, 0, 10) . ' ' . substr($r->facility_join, 11, 8);
                $user->save();
            }
        }

        foreach ($users as $u) {
            $delete = 0;
            foreach ($roster as $r) {
                $id = $r->cid;
                if ($u == $id) {
                    $delete = 1;
                }
            }
            if ($delete == '0') {
                $use = User::find($u);
                if ($use->visitor == 0 && $use->api_exempt == 0) {
                    $event_requests = EventRegistration::where('controller_id', $use->id)->get();
                    foreach ($event_requests as $e) {
                        $e->delete();
                    }
                    $use->status = 2;
                    $use->save();

                    $dossier = new MemberLog();
                    $dossier->user_target = $use->id;
                    $dossier->user_submitter = 0;
                    $dossier->content = "User has been removed from the ZDC roster.";
                    $dossier->save();
                }
            }
        }
    }

    public function getInitials($firstName, $lastName)
    {
        // Get actual initials
        $firstInitial = $firstName[0];
        $lastInitial = $lastName[0];
        $initials = $firstInitial . $lastInitial;
        // Find if initials already exist
        $existingInitials = User::where("initials", $initials)->first();
        // If exisiting initials were found
        if ($existingInitials) {
            // Split first name to a char array
            $firstNameArray = str_split($firstName);
            // Iterate through first name characters
            foreach ($firstNameArray as $letter) {
                // Create initials based on first name letter
                $initials = $letter . $lastInitial;
                // See if new initials exist
                $existingInitials = User::where("initials", $initials)->first();
                if ($existingInitials) {
                    continue;
                }
                return $initials;
            }
            // Split last name to a char array
            $lastNameArray = str_split($lastName);
            // Iterate through last name characters
            foreach ($lastNameArray as $letter) {
                // Create initials based on first name letter
                $initials = $firstInitial . $letter;
                // See if new initials exist
                $existingInitials = User::where("initials", $initials)->first();
                if ($existingInitials) {
                    continue;
                }
                return $initials;
            }
        } else {
            // Return actual initials
            return $initials;
        }
        // Return empty string
        return "";
    }
}
