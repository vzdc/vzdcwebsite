<?php

namespace App\Console\Commands;

use App\Loa;
use App\User;
use Mail;
use Illuminate\Console\Command;


class LoaEmailsAndExpiration extends Command
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
        $loas = Loa::where('status', 1)->get();
        $date = new \DateTime('now');

        $date_week_before = new \DateTime('now -7 days');

        foreach($loas as $loa) {
            $loa_date = new \DateTime($loa->end_date);
            if ($date <= $loa_date) {
                $loa->status = 3;
                $loa->save();

                $user = User::find($loa->controller_id);
                $user->status = 1;
                $user->save();

                Mail::send(['html' => 'emails.loas.expiration'], ['loa' => $loa, 'user' => $user], function ($m) use ($user) {
                    $m->from('loas@vzdc.org', 'vZDC LOA Center');
                    $m->subject('Your vZDC LOA Has Expired');
                    $m->to($user->email);
                });
            }
        }

        $loas = Loa::where('status', 2)->get();

        foreach($loas as $loa) {
            $loa_date = new \DateTime($loa->end_date);
            if ($date_week_before <= $loa_date) {
                $loa->status = 2;
                $loa->save();

                $user = User::find($loa->controller_id);

                Mail::send(['html' => 'emails.loas.expiration_soon'], ['loa' => $loa, 'user' => $user], function ($m) use ($user) {
                    $m->from('loas@vzdc.org', 'vZDC LOA Center');
                    $m->subject('Your vZDC LOA is Expiring Soon');
                    $m->to($user->email);
                });
            }
        }
    }
}