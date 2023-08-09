<?php

namespace App\Http\Controllers;

use App\Models\Course;

class SupportController extends Controller
{
    /**
     * Show the application calendar.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prepare
        return view('theme::support.index');
    }
}
