<?php

namespace App\Console\Commands;

use App\SoloCert;
use Carbon\Carbon;
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
    protected $description = 'Checks the expiration of solo certifications and removes them if time has expired.';

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
        $time_now = Carbon::now()->subMonth()->timestamp;
        $solo_certs = SoloCert::get();

        foreach($solo_certs as $s) {
            $created = new Carbon($s->created_at);
            $created = $created->timestamp;
            if($created < $time_now) {
                $controller = User::find($s->controller_id);
                if($s->position == 'twr'){
                    $rated = $controller->twr;
                    if($s->value == $rated) {
                        $controller->twr = $rated - 1;
                        $controller->save();
                    }
                } elseif($s->position == 'chp'){
                    $rated = $controller->chp;
                    if($s->value == $rated) {
                        $controller->chp = $rated - 1;
                        $controller->save();
                    }
                } elseif($s->position == 'app'){
                    $rated = $controller->app;
                    if($s->value == $rated) {
                        $controller->app = $rated - 1;
                        $controller->save();
                    }
                } elseif($s->position == 'ctr'){
                    $rated = $controller->ctr;
                    if($s->value == $rated) {
                        $controller->ctr = $rated - 1;
                        $controller->save();
                    }
                } elseif($s->position == 'mtv'){
                    $rated = $controller->mtv;
                    if($s->value == $rated) {
                        $controller->mtv = $rated - 1;
                        $controller->save();
                    }
                } elseif($s->position == 'shd'){
                    $rated = $controller->shd;
                    if($s->value == $rated) {
                        $controller->shd = $rated - 1;
                        $controller->save();
                    }
                }
                $s->delete();
            }
        }
    }
}
