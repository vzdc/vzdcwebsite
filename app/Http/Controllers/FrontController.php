<?php

namespace App\Http\Controllers;

use App\Airport;
use App\ATC;
use App\Calendar;
use App\ControllerLog;
use App\ControllerLogUpdate;
use App\Event;
use App\Feedback;
use App\File;
use App\Metar;
use App\Overflight;
use App\OverflightUpdate;
use App\Scenery;
use App\User;
use App\Variable;
use App\Visitor;
use Carbon\Carbon;
use Config;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Response;
use SimpleXMLElement;

class FrontController extends Controller
{
    public function home()
    {
        $atc = ATC::get();
        if ($atc) {
            $center = 0;
            $tracon = 0;
            $dca = 0;
            $iad = 0;
            $bwi = 0;

            foreach ($atc as $a) {
                $field = substr($a->position, 0, 3);
                $position = substr($a->position, -3);
                if ($field == 'DC_') {
                    if ($position == 'CTR') {
                        $center = 1;
                    }
                }
                if ($field == 'DCA' || $field == 'IAD' || $field == 'BWI' || $field == 'PCT') {
                    if ($position == 'APP' || $position == 'DEP') {
                        $tracon = 1;
                    }
                }
                if ($field == 'IAD') {
                    if ($position == 'TWR' || $position == 'GND') {
                        $iad = 1;
                    }
                }
                if ($field == 'DCA') {
                    if ($position == 'TWR' || $position == 'GND') {
                        $dca = 1;
                    }
                }
                if ($field == 'IAD') {
                    if ($position == 'TWR' || $position == 'GND') {
                        $iad = 1;
                    }
                }
                if ($field == 'BWI') {
                    if ($position == 'TWR' || $position == 'GND') {
                        $bwi = 1;
                    }
                }
            }
        }

        $airports = Airport::where('front_pg', 1)->orderBy('ltr_4', 'ASC')->get();
        $metar_update = Metar::first();
        if ($metar_update != null) {
            $metar_last_updated = substr($metar_update, -10, 5);
        } else {
            $metar_last_updated = null;
        }

        $controllers = ATC::get();
        $last_update = ControllerLogUpdate::first();
        $controllers_update = substr($last_update->created_at, -8, 5);

        $now = Carbon::now();

        $calendar = Calendar::where('type', '1')->where('staff', null)->get()->filter(function ($news) use ($now) {
            return strtotime($news->date . ' ' . $news->time) > strtotime($now);
        })->sortBy(function ($news) {
            return strtotime($news->date . ' ' . $news->time);
        });
        $news = Calendar::where('type', '2')->where('staff', null)->get()->filter(function ($news) use ($now) {
            return strtotime($news->date . ' ' . $news->time) < strtotime($now);
        })->sortByDesc(function ($news) {
            return strtotime($news->date . ' ' . $news->time);
        });
        $events = Event::where('status', 1)->get()->filter(function ($e) use ($now) {
            return strtotime($e->date . ' ' . $e->start_time) > strtotime($now);
        })->sortBy(function ($e) {
            return strtotime($e->date);
        });

        $flights = Overflight::where('dep', '!=', '')->where('arr', '!=', '')->take(15)->get();
        $flights_update = substr(OverflightUpdate::first()->updated_at, -8, 5);

        return view('site.home')->with('center', $center)->with('tracon', $tracon)->with('iad', $iad)->with('dca', $dca)->with('bwi', $bwi)
            ->with('airports', $airports)->with('metar_last_updated', $metar_last_updated)
            ->with('controllers', $controllers)->with('controllers_update', $controllers_update)
            ->with('calendar', $calendar)->with('news', $news)->with('events', $events)
            ->with('flights', $flights)->with('flights_update', $flights_update);
    }

    public function teamspeak()
    {
        return view('site.teamspeak');
    }

    public function airportIndex()
    {
        $airports = Airport::orderBy('ltr_3', 'ASC')->get();
        return view('site.airports.index')->with('airports', $airports);
    }

    public function searchAirport(Request $request)
    {
        $apt = $request->apt;
        return redirect('/pilots/airports/search?apt=' . $apt);
    }

    public function searchAirportResult(Request $request)
    {
        $apt = $request->apt;
        if (strlen($apt) == 3) {
            $apt_s = 'k' . strtolower($apt);
        } elseif (strlen($apt) == 4) {
            $apt_s = strtolower($apt);
        } else {
            return redirect()->back()->with('error', 'You either did not search for an airport or the airport ID is too long.');
        }

        $apt_r = strtoupper($apt_s);

        $client = new Client;
        $response_metar = $client->request('GET', 'https://www.aviationweather.gov/adds/dataserver_current/httpparam?dataSource=metars&requestType=retrieve&format=xml&hoursBeforeNow=2&mostRecentForEachStation=true&stationString=' . $apt_s);
        $response_taf = $client->request('GET', 'https://www.aviationweather.gov/adds/dataserver_current/httpparam?dataSource=tafs&requestType=retrieve&format=xml&hoursBeforeNow=2&mostRecentForEachStation=true&stationString=' . $apt_s);

        $root_metar = new SimpleXMLElement($response_metar->getBody());
        $root_taf = new SimpleXMLElement($response_taf->getBody());

        $metar = $root_metar->data->children()->METAR->raw_text;
        $taf = $root_taf->data->children()->TAF->raw_text;

        if ($metar == null) {
            return redirect()->back()->with('error', 'The airport code you entered is invalid.');
        }
        $metar = $metar->__toString();
        if ($taf != null) {
            $taf = $taf->__toString();
        }
        $visual_conditions = $root_metar->data->children()->METAR->flight_category->__toString();

        $res_a = $client->get('http://api.vateud.net/online/arrivals/' . $apt_s . '.json');
        $pilots_a = json_decode($res_a->getBody()->getContents(), true);

        if ($pilots_a) {
            $pilots_a = collect($pilots_a);
        } else {
            $pilots_a = null;
        }

        $res_d = $client->get('http://api.vateud.net/online/departures/' . $apt_s . '.json');
        $pilots_d = json_decode($res_d->getBody()->getContents(), true);

        if ($pilots_d) {
            $pilots_d = collect($pilots_d);
        } else {
            $pilots_d = null;
        }

        $client = new Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://api.aviationapi.com/v1/charts?apt=' . $apt_r);
        $status = $res->getStatusCode();
        if ($status == 404) {
            $charts = null;
        } elseif (json_decode($res->getBody()) != '[]') {
            $charts = collect(json_decode($res->getBody())->$apt_r);
            $min = $charts->where('chart_code', 'MIN');
            $hot = $charts->where('chart_code', 'HOT');
            $lah = $charts->where('chart_code', 'LAH');
            $apd = $charts->where('chart_code', 'APD');
            $iap = $charts->where('chart_code', 'IAP');
            $dp = $charts->where('chart_code', 'DP');
            $star = $charts->where('chart_code', 'STAR');
            $cvfp = $charts->where('chart_code', 'CVFP');
        } else {
            $charts = null;
        }

        return view('site.airports.search')->with('apt_r', $apt_r)->with('metar', $metar)->with('taf', $taf)->with('visual_conditions', $visual_conditions)->with('pilots_a', $pilots_a)->with('pilots_d', $pilots_d)
            ->with('charts', $charts)->with('min', $min)->with('hot', $hot)->with('lah', $lah)->with('apd', $apd)->with('iap', $iap)->with('dp', $dp)->with('star', $star)->with('cvfp', $cvfp);
    }

    public function showAirport($id)
    {
        $airport = Airport::find($id);

        $client = new Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://api.aviationapi.com/v1/charts?apt=' . $airport->ltr_4);
        $status = $res->getStatusCode();
        if ($status == 404) {
            $charts = null;
        } elseif (json_decode($res->getBody()) != '[]') {
            $apt_r = $airport->ltr_4;
            $charts = collect(json_decode($res->getBody())->$apt_r);
            $min = $charts->where('chart_code', 'MIN');
            $hot = $charts->where('chart_code', 'HOT');
            $lah = $charts->where('chart_code', 'LAH');
            $apd = $charts->where('chart_code', 'APD');
            $iap = $charts->where('chart_code', 'IAP');
            $dp = $charts->where('chart_code', 'DP');
            $star = $charts->where('chart_code', 'STAR');
            $cvfp = $charts->where('chart_code', 'CVFP');
        } else {
            $charts = null;
        }
        return view('site.airports.view')->with('airport', $airport)
            ->with('charts', $charts)->with('min', $min)->with('hot', $hot)->with('lah', $lah)->with('apd', $apd)->with('iap', $iap)->with('dp', $dp)->with('star', $star)->with('cvfp', $cvfp);
    }

    public function sceneryIndex(Request $request)
    {
        if ($request->search == null) {
            $scenery = Scenery::orderBy('airport', 'ASC')->get();
        } else {
            $scenery = Scenery::where('airport', $request->search)->orWhere('developer', $request->search)->orderBy('airport', 'ASC')->get();
        }

        $fsx = $scenery->where('sim', 0);
        $xp = $scenery->where('sim', 1);
        $afcad = $scenery->where('sim', 2);

        return view('site.scenery.index')->with('fsx', $fsx)->with('xp', $xp)->with('afcad', $afcad);
    }

    public function searchScenery(Request $request)
    {
        return redirect('/pilots/scenery?search=' . $request->search);
    }

    public function showScenery($id)
    {
        $scenery = Scenery::find($id);

        return view('site.scenery.show')->with('scenery', $scenery);
    }

    public function showStats($year = null, $month = null)
    {
        if ($year == null) {
            $year = date('y');
        }

        if ($month == null) {
            $month = date('n');
        }

        $stats = ControllerLog::aggregateAllControllersByPosAndMonth($year, $month);
        $all_stats = ControllerLog::getAllControllerStats();

        $homec = User::where('visitor', 0)->where('status', 1)->get();
        $visitc = User::where('visitor', 1)->where('status', 1)->get();

        $home = $homec->sortByDesc(function ($user) use ($stats) {
            return $stats[$user->id]->total_hrs;
        });

        $visit = $visitc->sortByDesc(function ($user) use ($stats) {
            return $stats[$user->id]->total_hrs;
        });

        $currency = Variable::where('name', 'currency')->first();

        return view('site.stats')->with('all_stats', $all_stats)->with('year', $year)
            ->with('month', $month)->with('stats', $stats)
            ->with('home', $home)->with('visit', $visit)
            ->with('currency', $currency);
    }

    public function visit()
    {
        $visitors = Variable::where('name', 'visitors')->first();
        return view('site.visit')->with('visitors', $visitors);
    }

    public function storeVisit(Request $request)
    {
        $validator = $request->validate([
            'cid' => 'required',
            'name' => 'required',
            'email' => 'required',
            'rating' => 'required',
            'home' => 'required',
            'reason' => 'required',
        ]);

        //Google reCAPTCHA Verification
        $client = new Client;
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => Config::get('google.recaptcha'),
                'response' => $request->input('g-recaptcha-response'),
            ],
        ]);
        $r = json_decode($response->getBody())->success;
        if ($r != true) {
            return redirect()->back()->with('error', 'You must complete the ReCaptcha to continue.');
        }

        $visit = new Visitor;
        $visit->cid = $request->cid;
        $visit->name = $request->name;
        $visit->email = $request->email;
        $visit->rating = $request->rating;
        $visit->home = $request->home;
        $visit->reason = $request->reason;
        $visit->status = 0;
        $visit->save();

        Mail::send('emails.visit.new', ['visit' => $visit], function ($message) use ($visit) {
            $message->from('notams@vzdc.org', 'vZDC Visiting Department')->subject('New Visitor Request Submitted');
            $message->to($visit->email)->cc('datm@vzdc.org')->cc('atm@vzdc.org');
        });

        return redirect('/')->with('success', 'Thank you for your interest in the ZDC ARTCC! Your visit request has been submitted.');
    }

    public function newFeedback()
    {
        $controllers = User::where('status', 1)->orderBy('lname', 'ASC')->get()->pluck('backwards_name_with_cid', 'id');
        return view('site.feedback')->with('controllers', $controllers);
    }

    public function saveNewFeedback(Request $request)
    {
        $validatedData = $request->validate([
            'controller' => 'required',
            'position' => 'required',
            'callsign' => 'required',
            'pilot_name' => 'required',
            'pilot_email' => 'required',
            'pilot_cid' => 'required',
        ]);

        //Google reCAPTCHA Verification
        $client = new Client;
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => Config::get('google.recaptcha'),
                'response' => $request->input('g-recaptcha-response'),
            ],
        ]);
        $r = json_decode($response->getBody())->success;
        if ($r != true) {
            return redirect()->back()->with('error', 'You must complete the ReCaptcha to continue.');
        }

        $feedback = new Feedback;
        $feedback->controller_id = Input::get('controller');
        $feedback->position = Input::get('position');
        $feedback->service_level = Input::get('service');
        $feedback->callsign = Input::get('callsign');
        $feedback->pilot_name = Input::get('pilot_name');
        $feedback->pilot_email = Input::get('pilot_email');
        $feedback->pilot_cid = Input::get('pilot_cid');
        $feedback->comments = Input::get('comments');
        $feedback->status = 0;
        $feedback->save();

        return redirect('/')->with('success', 'Thank you for the feedback! It has been recieved successfully.');
    }

    public function showPrivacyPolicy()
    {
        return view('site.privacy_policy');
    }

    public function showFiles()
    {
        $vrc = File::where('type', 0)->orderBy('name', 'ASC')->get();
        $vstars = File::where('type', 1)->orderBy('name', 'ASC')->get();
        $veram = File::where('type', 2)->orderBy('name', 'ASC')->get();
        $vatis = File::where('type', 3)->orderBy('name', 'ASC')->get();
        $sop = File::where('type', 4)->orderBy('name', 'ASC')->get();
        $loa = File::where('type', 5)->orderBy('name', 'ASC')->get();

        return view('site.files')->with('vrc', $vrc)->with('vstars', $vstars)->with('veram', $veram)->with('vatis', $vatis)->with('sop', $sop)->with('loa', $loa);
    }

    public function downloadFile($id)
    {
        $file = File::find($id);
        $file_path = $file->path;

        return Response::download($file_path);
    }

    public function showStaffRequest()
    {
        return view('site.request_staffing');
    }

    public function staffRequest(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'date' => 'required',
            'time' => 'required',
            'additional_information' => 'required',
        ]);

        //Google reCAPTCHA Verification
        $client = new Client;
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                'response' => $request->input('g-recaptcha-response'),
            ],
        ]);
        $r = json_decode($response->getBody())->success;

        if ($r == false) {
            return redirect()->back()->with('error', 'You must complete the ReCaptcha to continue.');
        }

        //Continue Request
        $name = $request->name;
        $email = $request->email;
        $org = $request->org;
        $date = $request->date;
        $time = $request->time;
        $exp = $request->additional_information;

        Mail::send('emails.request_staff', ['name' => $name, 'email' => $email, 'org' => $org, 'date' => $date, 'time' => $time, 'exp' => $exp], function ($message) use ($email, $name, $date) {
            $message->from('notams@vzdc.org', 'vZDC Staffing Requests')->subject('New Staffing Request for ' . $date);
            $message->to('events@vzdc.org')->replyTo($email, $name);
        });

        return redirect('/')->with('success', 'The staffing request has been delivered to the appropiate parties successfully. You should expect to hear back soon.');
    }
}
