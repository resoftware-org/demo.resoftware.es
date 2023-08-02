<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyagerThemeOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('theme_options')->delete();

        \DB::table('theme_options')->insert(array (
            0 =>
            array (
                'id' => 17,
                'theme_id' => 1,
                'key' => 'logo',
                'value' => 'settings/July2023/milestudios-logo-wide-light-500x180.png', // milestudioes.es wide logo
                'created_at' => '2017-11-22 16:54:46',
                'updated_at' => '2018-02-11 05:02:40'
            ),
            1 =>
            array(
                'id' => 18,
                'theme_id' => 1,
                'key' => 'home_headline',
                'value' => 'replay.guest.welcome_title',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2018-08-28 00:17:41'
            ),
            2 =>
            array(
                'id' => 19,
                'theme_id' => 1,
                'key' => 'home_subheadline',
                'value' => 'replay.guest.slogan_text',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2017-11-26 07:11:47'
            ),
            3 =>
            array(
                'id' => 20,
                'theme_id' => 1,
                'key' => 'home_description',
                'value' => 'replay.guest.welcome_paragraph',
                'created_at' => '2017-11-25 17:31:45',
                'updated_at' => '2017-11-26 07:09:50'
            ),
            4 =>
            array(
                'id' => 21,
                'theme_id' => 1,
                'key' => 'home_cta',
                'value' => 'replay.guest.signup',
                'created_at' => '2017-11-25 20:02:29',
                'updated_at' => '2020-10-23 20:17:25'
            ),
            5 =>
            array(
                'id' => 22,
                'theme_id' => 1,
                'key' => 'home_cta_url',
                'value' => '/register',
                'created_at' => '2017-11-25 20:09:33',
                'updated_at' => '2017-11-26 16:12:41'
            ),
            6 =>
            array(
                'id' => 23,
                'theme_id' => 1,
                'key' => 'home_promo_image',
                'value' => 'themes/February2018/mFajn4fwpGFXzI1UsNH6.png',
                'created_at' => '2017-11-25 21:36:46',
                'updated_at' => '2017-11-29 01:17:00'
            ),
            7 =>
            array(
                'id' => 24,
                'theme_id' => 1,
                'key' => 'footer_logo',
                'value' => 'settings/July2023/milestudios-logo-wide-light-500x180.png',
                'created_at' => '2018-08-28 23:12:11',
                'updated_at' => '2018-08-28 23:12:11'
            ),
            8 =>
            array (
                'id' => 25,
                'theme_id' => 1,
                'key' => 'dark_logo',
                'value' => 'settings/July2023/milestudios-logo-wide-dark-500x180.png', // milestudioes.es wide logo
                'created_at' => '2017-11-22 16:54:46',
                'updated_at' => '2018-02-11 05:02:40'
            ),
        ));
    }
}
