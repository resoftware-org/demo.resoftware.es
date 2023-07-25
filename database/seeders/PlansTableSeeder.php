<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('plans')->delete();

        \DB::table('plans')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'Signup for a Starter Plan to start watching courses now.',
                'features' => 'Watch online courses, Access to library',
                'plan_id' => '1',
                'role_id' => User::$ROLES["basic"],
                'default' => 0,
                'price' => '2',
                'trial_days' => 15,
                'created_at' => '2018-07-03 05:03:56',
                'updated_at' => '2018-07-03 17:17:24',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Mentor',
                'slug' => 'mentor',
                'description' => 'Signup for a Mentor Plan to start creating educational content.',
                'features' => 'Publish online courses, Access to library, Create learning materials',
                'plan_id' => '2',
                'role_id' => User::$ROLES["premium"],
                'default' => 1,
                'price' => '9',
                'trial_days' => 0,
                'created_at' => '2018-07-03 16:29:46',
                'updated_at' => '2018-07-03 17:17:08',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'College',
                'slug' => 'pro',
                'description' => 'Signup for a College Plan to start managing your college.',
                'features' => 'Publish online courses, Manage your library, Manage your college',
                'plan_id' => '3',
                'role_id' => User::$ROLES["pro"],
                'default' => 0,
                'price' => '25',
                'trial_days' => 14,
                'created_at' => '2018-07-03 16:30:43',
                'updated_at' => '2018-08-22 22:26:19',
            ),
        ));
    }
}
