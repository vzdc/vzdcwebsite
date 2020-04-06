<?php

namespace App\Http\Controllers;

use App\ControllerLog;
use App\User;

class CurrencyDash extends Controller
{
    public function CurrencyIndex($month = null, $year = null)
    {
        if ($year == null) {
            $year = date('y');
        }

        if ($month == null) {
            $month = date('n');
        }

        $stats = ControllerLog::aggregateAllControllersByPosAndMonth($year, $month);
        $homec = User::where('visitor', 0)->where('status', 1)->orderBy('lname', 'ASC')->get();
        $visitc = User::where('visitor', 1)->where('status', 1)->where('visitor_from', '!=', 'ZHU')->where('visitor_from', '!=', 'ZJX')->orderBy('lname', 'ASC')->get();
        $trainc = User::orderBy('lname', 'ASC')->get()->filter(function ($user) {
            return $user->hasRole('mtr') || $user->hasRole('ins');
        });

        return view('dashboard.admin.roster.purge')->with('stats', $stats)->with('homec', $homec)->with('visitc', $visitc)
            ->with('trainc', $trainc)->with('month', $month)->with('year', $year);
    }
}
