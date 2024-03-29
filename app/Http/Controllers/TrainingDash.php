<?php

namespace App\Http\Controllers;

use App\Audit;
use App\Ots;
use App\TrainingInfo;
use App\TrainingTicket;
use App\User;
use App\Feedback;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Config;
class TrainingDash extends Controller
{
    public function showATCast()
    {
        return view('dashboard.training.atcast');
    }

    public function trainingInfo()
    {
        $info_minor_gnd = TrainingInfo::where('section', 0)->orderBy('number', 'ASC')->get();
        $info_minor_lcl = TrainingInfo::where('section', 1)->orderBy('number', 'ASC')->get();
        $info_minor_app = TrainingInfo::where('section', 2)->orderBy('number', 'ASC')->get();
        $info_major_gnd = TrainingInfo::where('section', 3)->orderBy('number', 'ASC')->get();
        $info_major_lcl = TrainingInfo::where('section', 4)->orderBy('number', 'ASC')->get();
        $info_major_app = TrainingInfo::where('section', 5)->orderBy('number', 'ASC')->get();
        $info_ctr = TrainingInfo::where('section', 6)->orderBy('number', 'ASC')->get();
        return view('dashboard.training.info')->with('info_minor_gnd', $info_minor_gnd)->with('info_minor_lcl', $info_minor_lcl)->with('info_minor_app', $info_minor_app)
            ->with('info_major_gnd', $info_major_gnd)->with('info_major_lcl', $info_major_lcl)->with('info_major_app', $info_major_app)
            ->with('info_ctr', $info_ctr);
    }

    public function addInfo(Request $request, $section)
    {
        $replacing = TrainingInfo::where('number', '>', $request->number)->where('section', $section)->get();
        if ($replacing != null) {
            foreach ($replacing as $r) {
                $new = $r->number + 1;
                $r->number = $new;
                $r->save();
            }
        }
        $info = new TrainingInfo;
        $info->number = $request->number + 1;
        $info->section = $request->section;
        $info->info = $request->info;
        $info->save();
        return redirect()->back()->with('success', 'The information has been added successfully.');
    }

    public function deleteInfo($id)
    {
        $info = TrainingInfo::find($id);
        $other_info = TrainingInfo::where('number', '>', $info->number)->get();
        foreach ($other_info as $o) {
            $o->number = $o->number - 1;
            $o->save();
        }
        $info->delete();
        return redirect()->back()->with('success', 'The information has been removed successfully.');
    }

    public function ticketsIndex(Request $request)
    {
        $controllers = User::where('status', '1')->where('canTrain', '1')->orderBy('lname', 'ASC')->get()->pluck('backwards_name', 'id');
        if ($request->id != null) {
            $search_result = User::find($request->id);
        } else {
            $search_result = null;
        }
        if ($search_result != null) {
            $tickets_sort = TrainingTicket::where('controller_id', $search_result->id)->get()->sortByDesc(function ($t) {
                return strtotime($t->date . ' ' . $t->start_time);
            })->pluck('id');
            $tickets_order = implode(',', array_fill(0, count($tickets_sort), '?'));
            $tickets = TrainingTicket::whereIn('id', $tickets_sort)->orderByRaw("field(id,{$tickets_order})", $tickets_sort)->paginate(25);
            $ticketsRecent = null;
        } else {
            $tickets = null;
            $tickets_sort = TrainingTicket::get()->sortByDesc(function ($t) {
                return strtotime($t->date . ' ' . $t->start_time);
            })->pluck('id');
            $tickets_order = implode(',', array_fill(0, count($tickets_sort), '?'));
            $ticketsRecent = TrainingTicket::whereIn('id', $tickets_sort)->orderByRaw("field(id,{$tickets_order})", $tickets_sort)->take(10)->get();
        }

        return view('dashboard.training.tickets')->with('controllers', $controllers)->with('search_result', $search_result)->with('tickets', $tickets)->with('ticketsRecent', $ticketsRecent);
    }

    public function searchTickets(Request $request)
    {
        $search_result = User::find($request->cid);
        if ($search_result != null) {
            return redirect('/dashboard/training/tickets?id=' . $search_result->id);
        } else {
            return redirect()->back()->with('error', 'There is not controlling that exists with this CID.');
        }
    }

    public function newTrainingTicket(Request $request)
    {
        $c = $request->id;
        $controllers = User::where('status', '1')->where('canTrain', '1')->orderBy('lname', 'ASC')->get()->pluck('backwards_name', 'id');
        return view('dashboard.training.new_ticket')->with('controllers', $controllers)->with('c', $c);
    }

    public function saveNewTicket(Request $request)
    {
        $request->validate([
            'controller' => 'required',
            'position' => 'required',
            'facility' => 'required',
            'type' => 'required',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required',
            'duration' => 'required'
        ]);

        $ticket = new TrainingTicket;
        $ticket->controller_id = $request->controller;
        $ticket->trainer_id = Auth::id();
        $ticket->position = $request->position;
        $ticket->facility = $request->facility;
        $ticket->type = $request->type;
        $ticket->date = $request->date;
        $ticket->start_time = $request->start;
        $ticket->end_time = $request->end;
        $ticket->duration = $request->duration;
        $ticket->comments = $request->comments;
        $ticket->ins_comments = $request->trainer_comments;
        $ticket->no_show = $request->no_show;
        $ticket->score = $request->score;
        $ticket->save();
        $extra = null;

        $controller = User::find($ticket->controller_id);
        $trainer = User::find($ticket->trainer_id);

        if ($request->ots == 1) {
            $ots = new Ots;
            $ots->controller_id = $ticket->controller_id;
            $ots->recommender_id = $ticket->trainer_id;
            $ots->position = $ticket->position;
            $ots->facility = $ticket->facility;
            $ots->status = 0;
            $ots->save();
            $extra = ' and the OTS recommendation has been added';
        }

        Mail::send(['html' => 'emails.training_ticket'], ['ticket' => $ticket, 'controller' => $controller, 'trainer' => $trainer], function ($m) use ($controller, $ticket) {
            $m->from('notams@vzdc.org', 'vZDC Training Department');
            $m->subject('New Training Ticket Submitted');
            $m->to($controller->email)->cc('ta@vzdc.org');
        });

        $audit = new Audit;
        $audit->cid = Auth::id();
        $audit->ip = $_SERVER['REMOTE_ADDR'];
        $audit->what = Auth::user()->full_name . ' added a training ticket for ' . User::find($ticket->controller_id)->full_name . '.';
        $audit->save();

        if (!$ticket->no_show) {
            try {
                $date = new \DateTime($request->date);
                $dateString = $date->format('Y-m-d') . " " . $request->start;
                $client = new \GuzzleHttp\Client();
                $data = [
                    'json' => [
                        'instructor_id' => $ticket->trainer_id,
                        'session_date' => $dateString,
                        'position' => $ticket->position_central,
                        'duration' => $ticket->duration,
                        'notes' => $ticket->comments,
                        'location' => $ticket->type_central
                    ]
                ];
                $res = $client->post('https://api.vatusa.net/v2/user/'.$ticket->controller_id.'/training/record?apikey='.Config::get('vatusa.api_key'), $data);
            }
            catch (Exception $ex) {
                dd($ex);
            }
        }

        return redirect('/dashboard/training/tickets?id=' . $ticket->controller_id)->with('success', 'The training ticket has been submitted successfully' . $extra . '.');
    }

    public function viewTicket($id)
    {
        $ticket = TrainingTicket::find($id);
        return view('dashboard.training.view_ticket')->with('ticket', $ticket);
    }

    public function editTicket($id)
    {
        $ticket = TrainingTicket::find($id);
        if (Auth::id() == $ticket->trainer_id || Auth::user()->can('snrStaff')) {
            $controllers = User::where('status', '1')->where('canTrain', '1')->orderBy('lname', 'ASC')->get()->pluck('backwards_name', 'id');
            return view('dashboard.training.edit_ticket')->with('ticket', $ticket)->with('controllers', $controllers);
        } else {
            return redirect()->back()->with('error', 'You can only edit tickets that you have submitted unless you are the TA.');
        }
    }

    public function saveTicket(Request $request, $id)
    {
        $ticket = TrainingTicket::find($id);
        if (Auth::id() == $ticket->trainer_id || Auth::user()->can('snrStaff')) {
            $request->validate([
                'controller' => 'required',
                'position' => 'required',
                'facility' => 'required',
                'type' => 'required',
                'date' => 'required',
                'start' => 'required',
                'end' => 'required',
                'duration' => 'required'
            ]);

            $ticket->controller_id = $request->controller;
            $ticket->position = $request->position;
            $ticket->facility = $request->facility;
            $ticket->type = $request->type;
            $ticket->date = $request->date;
            $ticket->start_time = $request->start;
            $ticket->end_time = $request->end;
            $ticket->duration = $request->duration;
            $ticket->comments = $request->comments;
            $ticket->ins_comments = $request->trainer_comments;
            $ticket->score = $request->score;
            $ticket->save();

            $audit = new Audit;
            $audit->cid = Auth::id();
            $audit->ip = $_SERVER['REMOTE_ADDR'];
            $audit->what = Auth::user()->full_name . ' edited a training ticket for ' . User::find($request->controller)->full_name . '.';
            $audit->save();


            return redirect('/dashboard/training/tickets/view/' . $ticket->id)->with('success', 'The ticket has been updated successfully.');
        } else {
            return redirect()->back()->with('error', 'You can only edit tickets that you have submitted unless you are the TA.');
        }
    }

    public function deleteTicket($id)
    {
        $ticket = TrainingTicket::find($id);
        if (Auth::user()->can('snrStaff')) {
            $controller_id = $ticket->controller_id;
            $ticket->delete();

            $audit = new Audit;
            $audit->cid = Auth::id();
            $audit->ip = $_SERVER['REMOTE_ADDR'];
            $audit->what = Auth::user()->full_name . ' deleted a training ticket for ' . User::find($controller_id)->full_name . '.';
            $audit->save();

            return redirect('/dashboard/training/tickets?id=' . $controller_id)->with('success', 'The ticket has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Only the TA can delete training tickets.');
        }
    }

    public function otsCenter()
    {
        $ots_new = Ots::where('status', 0)->orderBy('created_at', 'DSC')->paginate(25);
        $ots_accepted = Ots::where('status', 1)->orderBy('created_at', 'DSC')->paginate(25);
        $ots_complete = Ots::where('status', 2)->orWhere('status', 3)->orderBy('created_at', 'DSC')->paginate(25);
        $instructors = User::orderBy('lname', 'ASC')->get()->filter(function ($user) {
            return $user->hasRole('ins');
        })->pluck('full_name', 'id');
        return view('dashboard.training.ots-center')->with('ots_new', $ots_new)->with('ots_accepted', $ots_accepted)->with('ots_complete', $ots_complete)->with('instructors', $instructors);
    }

    public function acceptRecommendation($id)
    {
        $ots = Ots::find($id);
        $ots->status = 1;
        $ots->ins_id = Auth::id();
        $ots->save();

        $audit = new Audit;
        $audit->cid = Auth::id();
        $audit->ip = $_SERVER['REMOTE_ADDR'];
        $audit->what = Auth::user()->full_name . ' accepted an OTS for ' . User::find($ots->controller_id)->full_name . '.';
        $audit->save();

        return redirect()->back()->with('success', 'You have sucessfully accepted this OTS. Please email the controller at ' . User::find($ots->controller_id)->email . ' in order to schedule the OTS.');
    }

    public function rejectRecommendation($id)
    {
        if (!Auth::user()->can('snrStaff')) {
            return redirect()->back()->with('error', 'Only the TA can reject OTS recommendations.');
        } else {
            $ots = Ots::find($id);
            $ots->delete();;
            return redirect()->back()->with('success', 'The OTS recommendation has been rejected successfully.');
        }
    }

    public function assignRecommendation(Request $request, $id)
    {
        if (!Auth::user()->can('snrStaff')) {
            return redirect()->back()->with('error', 'Only the TA can assign OTS recommendations to instructors.');
        } else {
            $ots = Ots::find($id);
            $ots->status = 1;
            $ots->ins_id = $request->ins;
            $ots->save();

            $ins = User::find($ots->ins_id);
            $controller = User::find($ots->controller_id);

            Mail::send('emails.ots_assignment', ['ots' => $ots, 'controller' => $controller, 'ins' => $ins], function ($m) use ($ins, $controller) {
                $m->from('notams@vzdc.org', 'vZDC OTS Center')->replyTo($controller->email, $controller->full_name);
                $m->subject('You Have Been Assigned an OTS for ' . $controller->full_name);
                $m->to($ins->email)->cc('ta@vzdc.org');
            });

            $audit = new Audit;
            $audit->cid = Auth::id();
            $audit->ip = $_SERVER['REMOTE_ADDR'];
            $audit->what = Auth::user()->full_name . ' assigned an OTS for ' . User::find($ots->controller_id)->full_name . ' to ' . User::find($ots->ins_id) . '.';
            $audit->save();

            return redirect()->back()->with('success', 'The OTS has been assigned successfully and the instructor has been notified.');
        }
    }

    public function completeOTS(Request $request, $id)
    {
        $validator = $request->validate([
            'result' => 'required',
        ]);

        $ots = Ots::find($id);

        if ($ots->ins_id == Auth::id()) {

            $ots->status = $request->result;
            $ots->save();

            $audit = new Audit;
            $audit->cid = Auth::id();
            $audit->ip = $_SERVER['REMOTE_ADDR'];
            $audit->what = Auth::user()->full_name . ' updated an OTS for ' . User::find($ots->controller_id)->full_name . '.';
            $audit->save();

            return redirect()->back()->with('success', 'The OTS has been updated successfully!');
        } else {
            return redirect()->back()->with('error', 'This OTS has not been assigned to you.');
        }
    }

    public function otsCancel($id)
    {
        $ots = Ots::find($id);
        $ots->ins_id = null;
        $ots->status = 0;
        $ots->save();

        $audit = new Audit;
        $audit->cid = Auth::id();
        $audit->ip = $_SERVER['REMOTE_ADDR'];
        $audit->what = Auth::user()->full_name . ' cancelled an OTS for ' . User::find($ots->controller_id)->full_name . '.';
        $audit->save();

        return redirect()->back()->with('success', 'The OTS has been unassigned from you and cancelled successfully.');
    }

    /**
     * Function to show feedback dropdown for instructors
     */
    public function ViewFeedback(Request $request) {
        // Get all controllers names and ids and order it by last name
        $controllers = User::orderBy('lname', 'ASC')->get()->pluck('backwards_name', 'id');

        if ($request->id != null) {
            $result = User::find($request->id);
        } else {
            $result = null;
        }
        if ($result != null) {
            $feedback = Feedback::where('controller_id', $result->id)
                                ->where('status', 1)->orderBy('created_at', 'DESC')->get();
        } else {
            $feedback = null;
        }

        return view('dashboard.training.feedback')->with('controllers', $controllers)->with('result', $result)->with('feedback', $feedback);
    }

    /**
     * Function to show all feedback of selected controller
     */
    public function searchFeedback(Request $request)
    {
        $result = User::find($request->cid);
        if ($result != null) {
            return redirect('/dashboard/training/feedback?id=' . $result->id);
        } else {
            return redirect()->back()->with('error', 'There is not controlling that exists with this CID.');
        }
    }
}
