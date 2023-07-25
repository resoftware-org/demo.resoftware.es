<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => User::$ROLES["admin"],
                'name' => 're:Software Support',
                'email' => 'support@resoftware.es',
                'username' => 'support',
                'avatar' => 'users/default.png',
                'password' => \Hash::make('NotSoSecureAdminPassword'),
                'remember_token' => '4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',
                'settings' => NULL,
                'created_at' => '2023-07-21 00:15:33',
                'updated_at' => '2023-07-21 00:15:34',
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'verification_code' => NULL,
                'verified' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'role_id' => User::$ROLES["trial"],
                'name' => 'Vivian Craft',
                'email' => 'trial@resoftware.es',
                'username' => 'free-trial-tester',
                'avatar' => 'users/woman-gray.png',
                'password' => \Hash::make('NotSoSecureTesterPassword'),
                'remember_token' => '4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',
                'settings' => NULL,
                'created_at' => '2023-07-21 00:15:33',
                'updated_at' => '2023-07-21 00:15:34',
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => '2024-07-21 00:15:33', // should be date()+1y
                'verification_code' => NULL,
                'verified' => 1,
            ),
        ));
    }
}