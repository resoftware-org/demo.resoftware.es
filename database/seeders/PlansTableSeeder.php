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
                'description' => 'replay.guest.pricing.plans_starter_desc',
                'features' => 'replay.guest.pricing.plans_starter_feat1, replay.guest.pricing.plans_starter_feat2',
                'plan_id' => '1',
                'role_id' => User::$ROLES["starter"],
                'default' => 0,
                'price' => '2',
                'trial_days' => setting('billing.trial_days', 7),
                'created_at' => '2018-07-03 05:03:56',
                'updated_at' => '2018-07-03 17:17:24',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Mentor',
                'slug' => 'mentor',
                'description' => 'replay.guest.pricing.plans_mentor_desc',
                'features' => 'replay.guest.pricing.plans_mentor_feat1, replay.guest.pricing.plans_mentor_feat2, replay.guest.pricing.plans_mentor_feat3',
                'plan_id' => '2',
                'role_id' => User::$ROLES["mentor"],
                'default' => 1,
                'price' => '9',
                'trial_days' => setting('billing.trial_days', 7),
                'created_at' => '2018-07-03 16:29:46',
                'updated_at' => '2018-07-03 17:17:08',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'College',
                'slug' => 'college',
                'description' => 'replay.guest.pricing.plans_college_desc',
                'features' => 'replay.guest.pricing.plans_college_feat1, replay.guest.pricing.plans_college_feat2, replay.guest.pricing.plans_college_feat3',
                'plan_id' => '3',
                'role_id' => User::$ROLES["college"],
                'default' => 0,
                'price' => '25',
                'trial_days' => setting('billing.trial_days', 7),
                'created_at' => '2018-07-03 16:30:43',
                'updated_at' => '2018-08-22 22:26:19',
            ),
        ));
    }
}
