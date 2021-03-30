<?php

namespace App\Console\Commands;

use App\ATC;
use App\User;
use App\ControllerLog;
use App\ControllerLogUpdate;
use App\Loa;
use App\MemberLog;
use Carbon\Carbon;
use DB;
use Mail;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class OnlineControllerUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OnlineControllers:GetControllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves all the online controllers and records them in the database.';

    protected $statusUrl = "http://status.vatsim.net/status.json";

    protected $facilities = [
        /* CENTER */
        'DC_C', 'DC_0', 'DC_1', 'DC_2', 'DC_3', 'DC_5', 'DC_N', 'DC_S', 'DC_E', 'DC_W', 'DC_I',
        /* BRAVO */
        'DCA_', 'IAD_', 'BWI_', 'PCT_', 'ADW_',
        /* CHARLIE */
        'RIC_', 'ROA_', 'ORF_', 'ACY_', 'NGU_', 'NTU_', 'NHK_', 'RDU_',
        /* DELTA */
        'CHO_', 'HGR_', 'LYH_', 'EWN_', 'LWB_', 'ISO_', 'MTN_', 'HEF_', 'MRB_', 'PHF_', 'SBY_', 'NUI_',
        'FAY_', 'ILM_', 'NKT_', 'NCA_', 'NYG_', 'DAA_', 'DOV_', 'POB_', 'GSB_', 'WAL_', 'CVN_', 'JYO_'
    ];

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
        $statsData = $this->getStatsData();
        $last_update_log = ControllerLogUpdate::get()->first();
        $last_update_log->delete();
        $update_now = new ControllerLogUpdate;
        $update_now->save();

        DB::table('online_atc')->truncate();

        // Iterate through entries in controllers array
        foreach ($statsData as $entry) {

            // Get fields from entry
            $cid = $entry->cid;
            $name = $entry->name;
            $position = $entry->callsign;
            $frequency = $entry->frequency;
            $logon = $entry->logon_time;

            // Check that it's a vZDC facility
            if(!in_array(substr($entry->callsign, 0, 4), $this->facilities)) {
                continue;
            }

            // Get timings
            $time_now = Carbon::now();
            $logon_time = new Carbon($logon);
            $duration = $time_now->diffInSeconds($logon_time);

            // Create ATC object
            ATC::create([
                'position' => $position,
                'freq' => $frequency,
                'name' => $name,
                'cid' => $cid,
                'time_logon' => $logon,
            ]);


            // Is this neccessary? It detects if the streamupdate of the last record for the user matches this one
            // Shouldn't bog anything down unless we are running this too often
            $MostRecentLog = ControllerLog::where('cid', $cid)->where('time_logon', $logon)->where('name', $name)->where('position', $position)->orderBy('time_logon', 'DESC')->first();

            // If there is nit an active controller log that matches, create a new one
            if (!$MostRecentLog || $MostRecentLog->time_logon != $logon) {
                ControllerLog::create([
                    'cid' => $cid,
                    'name' => $name,
                    'position' => $position,
                    'duration' => $duration,
                    'date' => date('n/j/y'),
                    'time_logon' => $logon,
                    'streamupdate' => strtotime($update_now->created_at),
                ]);
            } else {
                // Else update the existing one
                $MostRecentLog->duration = $duration;
                $MostRecentLog->streamupdate = strtotime($update_now->created_at);
                $MostRecentLog->save();
            }

            // Check for loa
            $loa = Loa::where('controller_id', $cid)->where('status', 1)->first();
            if ($loa != null) {
                $user = User::find($cid);
                $user->status = 1;
                $loa->status = 5;

                $user->save();
                $loa->save();

                Mail::send(['html' => 'emails.loas.controlled'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                    $m->from('notams@vzdc.org', 'vZDC LOA Center');
                    $m->subject('Your vZDC LOA Has Expired Due To Controlling');
                    $m->to($loa->controller_email)->cc("staff@vzdc.org");
                });

                $dossier = new MemberLog();
                $dossier->user_target = $user->id;
                $dossier->user_submitter = 0;
                $dossier->content = "LOA ended due to controlling";
                $dossier->confidential = 0;
                $dossier->save();
            }
        }
    }

    public function getStatsData()
    {
        // Get v3 url from status
        $data = false;
        $client = new Client();
        $statusResponse = $client->get($this->statusUrl);
        $statusJson = json_decode($statusResponse->getBody());
        $dataUrl = $statusJson->data->v3[0];

        // Get v3 json file
        $dataResponse = $client->get($dataUrl);
        $dataJson = json_decode($dataResponse->getBody());
        $streamUpdate = strval($dataJson->general->update);

        // Get controllers array from v3 json file
        $controllers = $dataJson->controllers;

        $update_time = gmmktime(
            substr($streamUpdate, 8, 2),
            substr($streamUpdate, 10, 2),
            substr($streamUpdate, 12, 2),
            substr($streamUpdate, 4, 2),
            substr($streamUpdate, 6, 2),
            substr($streamUpdate, 0, 4)
        );

        $age = time() - $update_time;
        if ($age < 600) {
            $data = $controllers;
        }

        if (!$data) {
            throw \Exception("No data source found that is younger than 10 minutes old.");
        }

        return $data;
    }
}
