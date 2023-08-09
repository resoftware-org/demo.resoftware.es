<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Wave\Http\Controllers\API\ApiController as Controller;
use Carbon\Carbon;

use App\Models\Course;

class ChartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function x_axis(): array
    {
        return [
            "today"  => ["12am", "1am", "2am", "3am", "4am", "5am", "6am", "7am", "8am", "9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm", "6pm", "7pm", "8pm", "9pm", "10pm", "11pm"],
            "7days"  => ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "30days" => ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th", "11th", "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th", "20th", "21st", "22nd", "23rd", "24th", "25th", "26th", "27th", "28th", "29th", "30th"],
        ];
    }

    protected function y_axis(Course $course): array
    {
        return [
            "today" => $course->reservations()->join(
                "schedules",
                "schedules.id", "=", "reservations.schedule_id"
            )->whereBetween("schedules.course_opens_at", [
                (new Carbon)->startOfDay()->toDateTimeString(),
                (new Carbon)->endOfDay()->toDateTimeString(),
            ]),
            "7days" => $course->reservations()->join(
                "schedules",
                "schedules.id", "=", "reservations.schedule_id"
            )->whereBetween("schedules.course_opens_at", [
                (new Carbon)->startOfWeek()->toDateString(),
                (new Carbon)->endOfWeek()->toDateString(),
            ]),
            "30days" => $course->reservations()->join(
                "schedules",
                "schedules.id", "=", "reservations.schedule_id"
            )->whereBetween("schedules.course_opens_at", [
                (new Carbon)->startOfMonth()->toDateString(),
                (new Carbon)->endOfMonth()->toDateString(),
            ]),
        ];
    }

    public function audience(Request $request)
    {
        $user = auth()->user();

        // authorize first
        if (! $user->can('browse', app(Course::class))){
            abort(403, 'Unauthorized');
        }

        // prepare x axis (labels)
        $labels = $this->x_axis();
        $data = ["dates" => []];

        foreach ($labels as $period => $x_slots):
            $data["dates"][$period]["data"] = [
                "labels" => $x_slots
            ];
        endforeach;

        // then prepare/execute queries
        $courses = Course::byAuthor($user)->get();
        if ($courses->isEmpty()) $courses = collect([]); 

        $today = $week = $month = 0;
        foreach ($courses as $course):
            // queries are per-course
            $query = $this->y_axis($course);

            // counts can be done already
            $today += (clone $query["today"])->count();
            $week += (clone $query["7days"])->count();
            $month += (clone $query["30days"])->count();

            // group by 1am, 2am, 3am, etc.
            $today_y = $query["today"]->selectRaw("
                count(reservations.id) as cnt,
                extract(hour from schedules.course_opens_at) as at_hour
            ")->groupBy("at_hour")->get()->toArray();

            $today_y = array_reduce(
                $today_y,
                function($carry, $item) {
                    $carry[$item["at_hour"]] = $item["cnt"];
                    return $carry;
                },
                []
            ) + array_fill(0, 24, 0);

            // group by Sun, Mon, Tue, etc.
            $weekly_y = $query["7days"]->selectRaw("
                count(reservations.id) as cnt,
                dayofweek(schedules.course_opens_at) as at_dow
            ")->groupBy("at_dow")->get()->toArray();

            $weekly_y = array_reduce(
                $weekly_y,
                function($carry, $item) {
                    $carry[$item["at_dow"]] = $item["cnt"];
                    return $carry;
                },
                []
            ) + array_fill(1, 7, 0);

            // group by 1st, 2nd, 3rd, etc.
            $monthly_y = $query["30days"]->selectRaw("
                count(reservations.id) as cnt,
                extract(day from schedules.course_opens_at) as at_day
            ")->groupBy("at_day")->get()->toArray();

            $monthly_y = array_reduce(
                $monthly_y,
                function($carry, $item) {
                    $carry[$item["at_day"]] = $item["cnt"];
                    return $carry;
                },
                []
            ) + array_fill(1, 30, 0);

            // add Y slot with one per course
            $data["dates"]["today"]["data"][$course->slug] = $today_y;
            $data["dates"]["7days"]["data"][$course->slug] = $weekly_y;
            $data["dates"]["30days"]["data"][$course->slug] = $monthly_y;
        endforeach;

        // compute totals
        $data["dates"]["today"]["total"] = $today;
        $data["dates"]["7days"]["total"] = $week;
        $data["dates"]["30days"]["total"] = $month;

        // respond JSON always
        return response()->json($data);
    }
}
