<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Schedule;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prepare
        $user = auth()->user();

        // fetch
        $courses = Course::whereAuthorId($user->id)->get();
        $schedules = Schedule::byMonth(date("m"))->byAuthor($user)->get();
        $reservations = Schedule::byMonth(date("m"))->withReservation($user)->get();

        // render
        return view('theme::dashboard.index', compact(
            "courses",
            "schedules",
            "reservations"
        ));
    }
}
