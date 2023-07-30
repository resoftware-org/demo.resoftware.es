<?php

namespace App\Http\Controllers;

use App\Models\Course;

class LibraryController extends Controller
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
        $courses = Course::paginate();
        $featured= Course::featured()->take(3);

        // prepare
        return view('theme::library.index', compact(
            "courses",
            "featured"
        ));
    }
}
