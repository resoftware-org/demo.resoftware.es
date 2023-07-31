<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Wave\Http\Controllers\API\ApiController as Controller;

use App\Models\Course;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $term = request('term');

        // authorize first
        if (! $user->can('browse', app(Course::class))){
            abort(403, 'Unauthorized');
        }

        // no empty search (min 2 characters)
        if (empty(trim($term)) || strlen($term) < 2) {
            abort(403, 'Unauthorized');
        }

        // then execute search
        $courses = Course::byTerm($term)->get();
        if ($courses->isEmpty()) $courses = collect([]);

        // respond JSON always
        return response()->json($courses->toArray());
    }
}
