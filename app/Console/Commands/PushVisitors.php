<?php

namespace App\Console\Commands;

use App\Loa;
use App\User;
use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use GuzzleHttp\Client;


class PushVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Roster:PushVisitors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push new visitors to visiting roster, runs daily.';

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
        $visitors = User::where('visitor', 1)->get();

        $client = new Client();

        foreach ($visitors as $visitor) {
            $client->request("POST", "https://api.vatusa.net/v2/facility/" . Config::get('vatusa.facility') . "/roster/manageVisitor/" . $visitor->id . "?apikey=" . Config::get('vatusa.api_key'));
        }
    }
}
