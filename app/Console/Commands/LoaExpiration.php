<?php

namespace App\Console\Commands;

use App\Loa;
use App\User;
use App\MemberLog;
use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;


class LoaExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LOAs:Expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates LOAs. Runs daily.';

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
        // Get accepted not started loas
        $not_started = Loa::where('status', 1)->get();
        
        // Check if loa has started
        $this->checkLoaStart($not_started);

        // Get all active loas
        $active = Loa::where('status', 2)->get();

        // Check if loa has ended
        $this->checkLoaEnd($active);
    }

    public function checkLoaStart($loas) {
        // Get todays date
        $today = new \DateTime('now');

        foreach($loas as $loa) {
            // Get start date
            $start = new \DateTime($loa->start_date);

            // Check if loa is accepted not started, and date is less than today
            if ($loa->status == 1 && $start >= $today) {
                // Set status to started
                $loa->status = 2;
                $loa->save();

                // Set user to on loa
                $user = User::find($loa->controller_id);
                $user->status = 0;
                $user->save();

                // Send email
                Mail::send(['html' => 'emails.loas.started'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                    $m->from('notams@vzdc.org', 'vZDC LOA Center');
                    $m->subject($loa->controller_name . "vZDC LOA Started");
                    $m->to($loa->controller_email)->bcc('staff@vzdc.org');
                });

                // Add dossier entry for loa start
                $dossier = new MemberLog();
                $dossier->user_submitter = 0;
                $dossier->user_target = $loa->controller_id;
                $dossier->content = "LOA Started";
                $dossier->confidential = 0;
                $dossier->save();
            }
        }
    }

    public function checkLoaEnd($loas) {
        // Get todays date
        $today = new \DateTime('now');

        foreach($loas as $loa) {
            // Get start date
            $end = new \DateTime($loa->end_date);

            // Check if loa is accepted not started, and date is less than today
            if ($loa->status == 1 && $end >= $today) {
                // Set status to ended
                $loa->status = 3;
                $loa->save();

                // Set user back to active
                $user = User::find($loa->controller_id);
                $user->status = 1;
                $user->save();

                // Send email
                Mail::send(['html' => 'emails.loas.expiration'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                    $m->from('notams@vzdc.org', 'vZDC LOA Center');
                    $m->subject($loa->controller_name . "vZDC LOA Has Expired");
                    $m->to($loa->controller_email)->bcc('staff@vzdc.org');
                });

                // Add dossier entry for loa ending
                $dossier = new MemberLog();
                $dossier->user_submitter = 0;
                $dossier->user_target = $loa->controller_id;
                $dossier->content = "LOA Ended";
                $dossier->confidential = 0;
                $dossier->save();
            }
        }
    }
}