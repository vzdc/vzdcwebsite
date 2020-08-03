<?php

namespace App\Console\Commands;

use Mail;
use App\Activity;
use App\ControllerLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Activity:CheckActivity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for warned controllers compliance. Runs daily.';

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
        $year = date('y');
        $month = date('n');
        $day = date('z');

        $date = new \DateTime('last day of this month');
        
        $activity = Activity::where('status', '!=', 4)->get();

        // All controller stats
        $stats = ControllerLog::aggregateAllControllersByPosAndMonth($year, $month);

        foreach($activity as $warnings) {
            if ($warnings->status == 1) {
                
            }
        }
    }
}
