<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Wave\KeyValue;
use Carbon\Carbon;

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
        $starter_role = User::$ROLES["starter"];
        $mentor_role  = User::$ROLES["mentor"];
        $college_role = User::$ROLES["college"];

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
                'created_at' => now(),
                'updated_at' => now(),
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
                'password' => \Hash::make('NotSoSecureTrialPassword'),
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => (string) (Carbon::now()->addYears(1)),
                'verification_code' => NULL,
                'verified' => 1,
            ),
        ));

        /***********************************************************************
         * DEMO STUDENTS
         **********************************************************************/

        $this->createUser(
            'Emily Johnson', 'demo.emily@resoftware.es', 'emily-johnson', $starter_role, 'f'
        );
        $this->createUser(
            'Ethan Patel', 'demo.ethan@resoftware.es', 'ethan-patel', $starter_role, 'm'
        );
        $this->createUser(
            'Sophia Ramirez', 'demo.sophia@resoftware.es', 'sophia-ramirez', $starter_role, 'f'
        );

        /***********************************************************************
         * DEMO MENTORS
         **********************************************************************/

        $this->createUser(
            'David Anderson', 'demo.david@resoftware.es', 'david-anderson', $mentor_role, 'm', 'Mr.'
        );
        $this->createUser(
            'Sarah Martinez', 'demo.sarah@resoftware.es', 'sarah-martinez', $mentor_role, 'f', 'Mrs.'
        );
        $this->createUser(
            'Michaela Williams', 'demo.michaela@resoftware.es', 'michael-williams', $mentor_role, 'f', 'Miss'
        );

        /***********************************************************************
         * DEMO COLLEGES
         **********************************************************************/

        $this->createUser(
            'Harmony University', 'demo.harmony@resoftware.es', 'uni-harmony', $college_role
        );
        $this->createUser(
            'Vanguard College', 'demo.vanguard@resoftware.es', 'vanguard-college', $college_role
        );
        $this->createUser(
            'Stellar Institute', 'demo.stellar@resoftware.es', 'stellar-institute', $college_role
        );
    }

    /**
     *
     */
    protected function createUser(
        string $name,
        string $email,
        string $username,
        int    $role_id,
        string $gender = null,
        string $title = null,
    ) {
        $list_of_avatars = [
            "users/avatar-woman-1.png",
            "users/avatar-woman-2.png",
            "users/avatar-woman-3.png",
            "users/avatar-woman-4.png",
            "users/avatar-man-1.png",
            "users/avatar-man-2.png",
            "users/avatar-man-3.png",
            "users/avatar-man-4.png",
        ];

        $pw_type = "Starter";
        if ($role_id === User::$ROLES["mentor"]) $pw_type = "Mentor";
        elseif ($role_id === User::$ROLES["college"]) $pw_type = "College";

        $user = User::updateOrCreate(
            ["email" => $email],
            [
                "role_id"   => $role_id,
                "name"      => $name,
                "email"     => $email,
                "username"  => $username,
                "avatar"    => $list_of_avatars[mt_rand(0, 7)],
                "password"  => \Hash::make('NotSoSecure' . $pw_type . 'Password'),
                "remember_token" => NULL,
                "settings" => NULL,
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'verification_code' => NULL,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        if ($gender !== null) {
            $meta_gender = KeyValue::create([
                'type' => 'select_dropdown',
                'keyvalue_id' => $user->id,
                'keyvalue_type' => 'users',
                'key' => 'gender',
                'value' => $gender,
            ]);
        }

        if ($title !== null) {
            $meta_title = KeyValue::create([
                'type' => 'select_dropdown',
                'keyvalue_id' => $user->id,
                'keyvalue_type' => 'users',
                'key' => 'title',
                'value' => $title,
            ]);
        }
    }
}