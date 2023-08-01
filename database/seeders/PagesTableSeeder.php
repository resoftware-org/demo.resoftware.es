<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pages')->delete();

        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'author_id' => 1,
                'title' => 'Hello milestudios.es',
                'excerpt' => 'Welcome to milestudios.es, the ultimate social gaming platform that brings friends and players together like never before!',
                'body' => '<p>Welcome to <a href="https://play.resoftware.es">milestudios.es</a>, the ultimate social gaming platform that brings friends and players together like never before! Step into a vibrant world where gaming meets social interaction, and embark on thrilling adventures that transcend traditional boundaries.</p>
                <p>With milestudios.es, you can connect with friends, old and new, from all corners of the globe, and experience the joy of playing together in real-time. Explore a vast array of games catering to all tastes and skill levels, whether you\'re a casual gamer or a seasoned pro.</p>
                <p>Compete in challenges, form teams, and celebrate victories together as you unlock achievements and rise through the ranks. Join the social gaming revolution and let <b>milestudios.es</b> redefine the way you play, connect, and experience the joys of gaming.</p>',
                'image' => 'pages/page1.jpg',
                'slug' => 'hello-replay',
                'meta_description' => 'Welcome to milestudios.es, the ultimate social gaming platform that brings friends and players together like never before! Step into a vibrant world where gaming meets social interaction, and embark on thrilling adventures that transcend traditional boundaries.',
                'meta_keywords' => 'social, gaming, online, multiplayer, earn, win, friends, player, online game, games',
                'status' => 'ACTIVE',
                'created_at' => '2017-11-21 16:23:23',
                'updated_at' => '2017-11-21 16:23:23',
            ),
        ));
    }
}