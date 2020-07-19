<?php

namespace App\Console\Commands;

use Mail;
use App\SoloCert;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SoloCerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SoloCerts:Expiration';

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
        $today = strval(Carbon::now()->subDay());
        $today = substr($today, 0, 10);
        $certs = SoloCert::get();

        foreach ($certs as $c) {
            if ($c->expiration <= $today && $c->status == 1) {
                $c->status = 2;
                $user = User::find($c->cid);
                if ($c->pos == 0) {
                    $user->twr = 0;
                } elseif ($c->pos == 1) {
                    $user->shd = 0;
                } elseif ($c->pos == 2) {
                    $user->chp = 0;
                } elseif ($c->pos == 3) {
                    $user->mtv = 0;
                } elseif ($c->pos == 4) {
                    $user->app = 0;
                } elseif ($c->pos == 5) {
                    $user->ctr = 0;
                }
                $user->save();
                $c->save();

                Mail::send('emails.solocert_expire', ['user' => $user], function ($message) use ($user) {
                    $message->from('notams@vzdc.org', 'vZDC Training Department')->subject('Solo Certification Expired');
                    $message->to($user->email);
                });
            }
        }
    }
}
