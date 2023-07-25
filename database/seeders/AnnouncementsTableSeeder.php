<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('announcements')->delete();

        \DB::table('announcements')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 're:Play 1.0 Released',
                'description' => 'We have just released the first official version of re:Play. Click here to learn more!',
                'body' => '<p>Welcome to <a href="https://play.resoftware.es">re:Play</a>, the ultimate social gaming platform that brings friends and players together like never before! Step into a vibrant world where gaming meets social interaction, and embark on thrilling adventures that transcend traditional boundaries.</p>
<p>With re:Play, you can connect with friends, old and new, from all corners of the globe, and experience the joy of playing together in real-time. Explore a vast array of games catering to all tastes and skill levels, whether you\'re a casual gamer or a seasoned pro.</p>
<p>Compete in challenges, form teams, and celebrate victories together as you unlock achievements and rise through the ranks. Join the social gaming revolution and let <b>re:Play</b> redefine the way you play, connect, and experience the joys of gaming.</p>',
            'created_at' => '2018-05-20 23:19:00',
            'updated_at' => '2018-05-21 00:38:02',
            ))
        );
    }
}
