<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Wave\Category;
use Carbon\Carbon;

// models
use App\Models\User;
use App\Models\Course;
use App\Models\Download;
use App\Models\Schedule;
use App\Models\Reservation;

class ReplayDataSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // first truncate
        \DB::table('schedules')->delete();
        \DB::table('downloads')->delete();
        \DB::table('courses')->delete();

        $cat_creative = Category::where("slug", "creative-arts")->first();

        /***********************************************************************
         * DEMO COURSES
         **********************************************************************/
        $example_01 = $this->createCourse(
            $cat_creative,
            "demo.david@resoftware.es", // mentor role
            "Math for Beginners",
            "Embark on a captivating journey into the world of numbers and "
            . "equations with our comprehensive online mathematics course. "
            . "Master essential concepts, problem-solving techniques, and "
            . "real-life applications in a user-friendly, interactive learning "
            . "environment. Whether you're a beginner or looking to sharpen your "
            . "skills, our expert instructors will guide you every step of the "
            . "way. Join now and discover the beauty and power of mathematics!",
            "courses/July2023/online-course-1.png",
            true
        );

        $example_02 = $this->createCourse(
            $cat_creative,
            "demo.sarah@resoftware.es", // mentor role
            "Science for Beginners",
            "Unleash your curiosity and explore the wonders of science through "
            . "our engaging online course. Dive into captivating topics, conduct "
            . "exciting experiments, and unravel the mysteries of the universe. "
            . "Led by passionate instructors, this course will spark your interest "
            . "in biology, chemistry, physics, and more. Whether you're a budding "
            . "scientist or simply curious about the world around you, our interactive "
            . "lessons and hands-on activities will ignite your love for learning. "
            . "Join us today and embark on a thrilling scientific adventure!",
            "courses/July2023/online-course-2.png",
            true
        );

        $example_03 = $this->createCourse(
            $cat_creative,
            "demo.michaela@resoftware.es", // mentor role
            "Biology for Beginners",
            "Embark on a fascinating journey into the living world with our dynamic "
            . "online biology course. Delve into the intricacies of life, from cells "
            . "to ecosystems, as we explore genetics, evolution, and physiology. Led "
            . "by expert biologists, this course offers a blend of engaging lectures, "
            . "interactive quizzes, and hands-on experiments to deepen your understanding. "
            . "Whether you're a student pursuing a career in life sciences or simply curious "
            . "about the natural world, our course will nurture your passion for biology. "
            . "Enroll now and uncover the secrets of life!",
            "courses/July2023/online-course-3.png",
            true
        );

        /***********************************************************************
         * DEMO SCHEDULES
         **********************************************************************/
        $this->createSchedules(
            $example_01,
            [
                Carbon::now(), // today
                Carbon::now()->addDays(1),
                Carbon::now()->addDays(3),
                Carbon::now()->addDays(5),
                Carbon::now()->addDays(7),
                Carbon::now()->addDays(9),
                Carbon::now()->addDays(11),
                Carbon::now()->addDays(13),
                Carbon::now()->addDays(15),
                Carbon::now()->addDays(17),
                Carbon::now()->addDays(19),
                Carbon::now()->addDays(21),
            ],
            true
        );

        $this->createSchedules(
            $example_02,
            [
                Carbon::now(), // today
                Carbon::now()->addDays(1),
                Carbon::now()->addDays(2),
                Carbon::now()->addDays(3),
                Carbon::now()->addDays(4),
                Carbon::now()->addDays(5),
                Carbon::now()->addDays(6),
                Carbon::now()->addDays(7),
                Carbon::now()->addDays(8),
                Carbon::now()->addDays(9),
                Carbon::now()->addDays(10),
                Carbon::now()->addDays(11),
            ],
            true
        );

        $this->createSchedules(
            $example_03,
            [
                Carbon::now()->addHours(1),
                Carbon::now()->addHours(2),
                Carbon::now()->addHours(3),
                Carbon::now()->addDays(1),
                Carbon::now()->addDays(1)->addHours(1),
                Carbon::now()->addDays(1)->addHours(2),
                Carbon::now()->addDays(1)->addHours(3),
                Carbon::now()->addDays(3),
                Carbon::now()->addDays(5),
                Carbon::now()->addDays(7),
                Carbon::now()->addDays(9),
                Carbon::now()->addDays(11),
                Carbon::now()->addDays(13),
                Carbon::now()->addDays(15),
            ],
            true
        );
    }

    /**
     * Create or update a BREAD `data_types` entry.
     * 
     * @return TCG\Voyager\Models\DataType
     */
    protected function createCourse(
        Category $category,
        string $email,
        string $title,
        string $description,
        string $image,
        bool $featured = false,
    )
    {
        $slug = \Str::slug($title);
        $user = User::whereEmail($email)->first();
        return Course::updateOrCreate(
            ['slug' => $slug],
            [
                'author_id' => $user->id,
                'category_id' => $category->id,
                'status' => 'PUBLISHED',
                'title' => $title,
                'seo_title' => $title,
                'excerpt' => \Str::excerpt($description),
                'description' => $description,
                'image' => $image,
                'meta_description' => $description,
                'featured' => $featured,
            ]);
    }

    /**
     *
     */
    protected function createSchedules(
        Course $course,
        array $dates,
        bool $withReservation = false
    ) {
        foreach ($dates as $schedule_at):
            $schedule = Schedule::create([
                'author_id' => $course->author_id,
                'course_id' => $course->id,
                'meeting_url' => 'https://live.milestudios.es/@' . $course->user->username,
                'meeting_password' => null,
                'course_opens_at' => (new Carbon($schedule_at))->subMinutes(30),
                'course_starts_at' => new Carbon($schedule_at),
                'course_ends_at' => (new Carbon($schedule_at))->addHours(4),
            ]);

            if ($withReservation === true):
                $users = User::where("users.email", "!=", $course->user->email)->get();

                foreach ($users as $student):
                    $roulette = rand(0,1) == 1;
                    if ($roulette !== true)
                        continue;

                    Reservation::create([
                        "user_id" => $student->id,
                        "course_id" => $course->id,
                        "schedule_id" => $schedule->id,
                    ]);
                endforeach;
            endif;
        endforeach;
    }
}
