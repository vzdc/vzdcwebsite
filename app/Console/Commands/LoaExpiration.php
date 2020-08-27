<?php

namespace App\Console\Commands;

use App\Loa;
use App\User;
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
        $today = Carbon::now()->format('m/d/Y');

        $startingLoas = Loa::where('start_date', $today)->where('status', 1);
        
        foreach($startingLoas as $loa) {
            $loa->status = 2;
            $user = User::find($loa->controller_id);
            $user->status = 0;

            $loa->save();
            $user->save();
        }

        $endingLoas = Loa::where('end_date', $today)->where('status', 2)->get();

        foreach($endingLoas as $loa) {
            $loa->status = 3;
            $loa->save();

            $user = User::find($loa->controller_id);
            $user->status = 1;
            $user->save();

            Mail::send(['html' => 'emails.loas.expiration'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                $m->from('notams@vzdc.org', 'vZDC LOA Center');
                $m->subject('Your vZDC LOA Has Expired');
                $m->to($loa->controller_email);
            });
        }
    }
}