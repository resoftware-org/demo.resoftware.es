<?php

namespace App\Http\Controllers;

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
        return view('theme::calendar.index');
    }
}
