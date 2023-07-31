<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\Reservation;

class CalendarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prepare
        $user  = auth()->user();
        $month = date("m");

        if ($user->subscribed("mentor") || $user->subscribed("college"))
            // teachers see own schedules
            $schedules = Schedule::byMonth($month)->byAuthor($user)->get();
        else
            // students see reserved schedules
            $schedules = Schedule::byMonth($month)->withReservation($user)->get();

        // prepare
        return view('theme::calendar.index', compact(
            "schedules"
        ));
    }
}
