<?php

namespace App\Console\Commands;

use Mail;
use App\TrainingTicket;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateTrainingTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateTrainingTickets:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates solo certs. Runs daily.';

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
        $tickets = TrainingTicket::get();

        foreach ($tickets as $ticket) {
            if ($ticket->position == 0) {
                $ticket->position = 2;
            }
            else if ($ticket->position == 1) {
                $ticket->position = 3;
            }
            else if ($ticket->position == 2) {
                $ticket->position = 5;
            }
            else if ($ticket->position == 3) {
                $ticket->position = 6;
            }
            $ticket->save();
        }
    }
}
