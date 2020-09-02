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
        $today = new \DateTime('now');

        $loas = Loa::get();
        
        foreach($loas as $loa) {

            $date = new \DateTime($loa->start_date);

            if ($loa->status = 1) {
                if ($date >= $today) {
                    $loa->status = 2;
                    $loa->save();

                    $user = User::find($loa->controller_id);
                    $user->status = 0;
                    $user->save();

                    Mail::send(['html' => 'emails.loas.started'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                        $m->from('notams@vzdc.org', 'vZDC LOA Center');
                        $m->subject('Your vZDC LOA Has Started');
                        $m->to($loa->controller_email)->bcc('staff@vzdc.org');
                    });

                    $dossier = new MemberLog();
                    $dossier->user_submitter = 0;
                    $dossier->user_target = $loa->controller_id;
                    $dossier->content = "LOA Started";
                    $dossier->confidential = 0;
                    $dossier->save();
                }
            }

            if ($loa->status = 2) {
                if ($date <= $today) {
                    $loa->status = 3;
                    $loa->save();
        
                    $user = User::find($loa->controller_id);
                    $user->status = 1;
                    $user->save();
        
                    Mail::send(['html' => 'emails.loas.expiration'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                        $m->from('notams@vzdc.org', 'vZDC LOA Center');
                        $m->subject('Your vZDC LOA Has Expired');
                        $m->to($loa->controller_email)->bcc('staff@vzdc.org');
                    });

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
}