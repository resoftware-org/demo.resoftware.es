<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WaveKeyValuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('wave_key_values')->delete();

        \DB::table('wave_key_values')->insert(array (
            0 =>
            array (
                'id' => 10,
                'type' => 'text_area',
                'keyvalue_id' => 1, // re:Software Support
                'keyvalue_type' => 'users',
                'key' => 'about',
                'value' => 'Hello I am the re:Software Support user. You can chat with me if you have any queries about this platform.',
            ),
            1 =>
            array (
                'id' => 11,
                'type' => 'date',
                'keyvalue_id' => 1, // re:Software Support
                'keyvalue_type' => 'users',
                'key' => 'date_of_birth',
                'value' => '1988-08-29',
            ),
            1 =>
            array (
                'id' => 11,
                'type' => 'hidden',
                'keyvalue_id' => 1, // re:Software Support
                'keyvalue_type' => 'users',
                'key' => 'gender',
                'value' => 'm',
            ),
        ));
    }
}
