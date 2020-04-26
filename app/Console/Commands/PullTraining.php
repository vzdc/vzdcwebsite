<?php

namespace App\Console\Commands;

use App\TrainingTicket;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class PullTraining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PullTraining:PullTraining';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls old training information.';

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
        $data = DB::table('training')->get();
        foreach ($data as $d) {
            $ticket = new TrainingTicket;
            $ticket->controller_id = $d->CtlId;
            $ticket->trainer_id = $d->MtrId;
            $ticket->comments = $d->comments . ' ' . $d->remarks;
            $ticket->ins_comments = $d->notes;
            $ticket->date = Carbon::createFromTimestamp(strtotime($d->sessionStart))->format('m/d/Y');
            $ticket->start_time = substr($d->sessionStart, 11, 5);
            $ticket->end_time = substr($d->sessionEnd, 11, 5);
            $ticket->duration = 'N/A';
            if ($d->position == 'DELGND') {
                $ticket->position = 0;
            } elseif ($d->position == 'TWR') {
                $ticket->position = 1;
            } elseif ($d->position == 'TRACON') {
                $ticket->position = 2;
            } elseif ($d->position == 'CTR') {
                $ticket->position = 3;
            }
            if ($d->facility == 'KIAD') {
                $ticket->facility = 0;
            } elseif ($d->facility == 'KBWI') {
                $ticket->facility = 1;
            } elseif ($d->facility == 'KDCA') {
                $ticket->facility = 2;
            } elseif ($d->facility == 'KORF') {
                $ticket->facility = 3;
            } elseif ($d->facility == 'KZDC') {
                $ticket->facility = 4;
            }
            if ($d->OTS == 1) {
                $ticket->type = 8;
            } else {
                $ticket->type = 9;
            }
            $ticket->save();
        }
        print('Done.');
    }
}
