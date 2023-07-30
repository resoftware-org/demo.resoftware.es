<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        // fetch
        $schedules = Schedule::byMonth(date("m"))->byAuthor(auth()->user())->get();

        // prepare
        return view('theme::calendar.index', compact(
            "schedules",
        ));
    }
}
