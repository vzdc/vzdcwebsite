<?php

namespace App\Console\Commands;

use Mail;
use App\Activity;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Currency:CheckCurrency';

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
        $today = new \DateTime('now');
        $activity = Activity::where('status', '!=', 3)->get();
    }
}
