<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;

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
    public function index(string $month = null, string $year = null)
    {
        // prepare
        $user  = auth()->user();
        $year  = $year === null ? date("Y") : $year;
        $month = $month === null ? date("m") : $month;

        // events that "I created"
        $schedules = Schedule::byMonth($month)->byAuthor($user)->get();

        // events that "I join"
        $reservations = Schedule::byMonth($month)->withReservation($user)->get();

        // prepare
        return view('theme::calendar.index', compact(
            "year",
            "month",
            "schedules",
            "reservations"
        ));
    }
}
