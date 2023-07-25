<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReplayTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        /* ! do not delete/truncate, this is done in DataTypesTableSeeder. ! */

        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 9, // in continuation from DataTypesTableSeeder
                'name' => 'courses',
                'slug' => 'courses',
                'display_name_singular' => 'Course',
                'display_name_plural' => 'Courses',
                'icon' => 'voyager-news',
                'model_name' => 'TCG\\Voyager\\Models\\Post',
                'policy_name' => 'TCG\\Voyager\\Policies\\PostPolicy',
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2017-11-21 16:23:22',
                'updated_at' => '2017-11-21 16:23:22',
            ),
        ));
    }
}