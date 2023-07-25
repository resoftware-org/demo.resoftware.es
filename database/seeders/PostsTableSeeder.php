<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();

        \DB::table('posts')->insert(array (
            0 =>
            array (
                'id' => 6,
                'author_id' => 1,
                'category_id' => 1, // "Reviews"
                'title' => 'Game review for F1 23',
                'seo_title' => 'Game review for F1 23',
                'excerpt' => NULL,
                'body' => '<p>F1 23, the latest installment in the iconic Formula 1 racing game series, is an exhilarating and pulse-pounding experience that takes virtual racing to a whole new level. Developed with meticulous attention to detail and an unwavering commitment to authenticity, F1 23 captures the essence of Formula 1 racing like no other.</p>
<p>Visually stunning, the game\'s graphics are a feast for the eyes. From the meticulously crafted race tracks to the hyper-realistic rendering of the iconic F1 cars, every detail is so lifelike that you\'d swear you were watching a real-world race unfold. The attention to detail extends to the dynamic weather system, which adds an extra layer of challenge as players must adapt their strategies to changing track conditions.</p>
<p>F1 23 boasts an extensive roster of drivers and teams, including the latest season\'s lineup, making it the ultimate dream-come-true for F1 enthusiasts. Players can step into the shoes of their favorite drivers or create their own custom avatar, and with a career mode that spans multiple seasons, the game offers an immersive experience that keeps players engaged for hours on end.</p>
<p>The gameplay is where F1 23 truly shines. The controls are responsive and precise, offering a perfect balance between accessibility for newcomers and depth for veteran players. As you race wheel-to-wheel with AI opponents or engage in competitive multiplayer mode, you\'ll feel the adrenaline rush of every high-speed corner and strategic overtaking maneuver. The game\'s AI also impresses, with opponents displaying a mix of aggression and intelligence, ensuring that each race is a challenge.</p>
<p>Beyond the core racing experience, F1 23 also offers an array of additional features, including a robust car customization system, where players can fine-tune their vehicle\'s performance to gain a competitive edge. The multiplayer mode is a standout, providing endless hours of competitive fun as you battle it out with other players from around the world.</p>
<p>However, F1 23 is not without its minor drawbacks. Loading times can be a bit lengthy, especially when transitioning between menus, and some players have reported occasional bugs that affect immersion. Nonetheless, the developers have shown commendable commitment to addressing issues through regular updates and patches.</p>
<p>In conclusion, F1 23 is a must-play for racing enthusiasts and gamers alike. With its stunning visuals, immersive gameplay, and an ever-growing community, the game continues to push the boundaries of what a racing simulator can achieve. Strap in, rev your engines, and prepare for an adrenaline-fueled journey into the thrilling world of Formula 1 racing.</p>',
                'image' => 'posts/March2018/h86hSqPMkT9oU8pjcrSu.jpg',
                'slug' => 'game-review-f1-23',
                'meta_description' => 'F1 23, the latest installment in the iconic Formula 1 racing game series, is an exhilarating and pulse-pounding experience that takes virtual racing to a whole new level.',
                'meta_keywords' => 'game, review, f1, formula 1, f1 23',
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2018-03-26 02:55:01',
                'updated_at' => '2018-03-26 02:13:05',
            ),
            1 =>
            array (
                'id' => 5,
                'author_id' => 1,
                'category_id' => 2, // "Stories"
                'title' => 'Embracing the Metaverse: A New Frontier of Digital Exploration',
                'seo_title' => 'Embracing the Metaverse: A New Frontier of Digital Exploration',
                'excerpt' => NULL,
                'body' => '<p>In the vast landscape of technological advancements, a new frontier has emerged - the Metaverse. The concept, once confined to the realm of science fiction, is now becoming a tangible reality. With companies investing heavily in virtual reality (VR), augmented reality (AR), and blockchain technology, the Metaverse is poised to revolutionize the way we interact, work, and play in the digital world. Joining the Metaverse is not just about donning a headset; it represents an immersive leap into a parallel digital universe, where the boundaries between the physical and digital realms blur and limitless possibilities await.</p>
<h2>What is the Metaverse</h2>
<p>The Metaverse can be best described as an interconnected, collective virtual space that transcends individual platforms, offering a seamless and immersive experience. It is a convergence of virtual reality, augmented reality, and the internet, creating a shared digital universe that users can explore, interact with others, and build upon. Picture a vast interconnected web of virtual worlds, each with its unique landscapes, economies, and social ecosystems.</p>
<h2>Embracing the Metaverse: A journey of Possibilities</h2>
<p>Joining the Metaverse opens up a world of possibilities across various aspects of life:</p>
<p>1. <b>Work and Collaboration</b>: The traditional office space is evolving rapidly. In the Metaverse, remote work takes on a whole new meaning as colleagues from different parts of the globe can virtually collaborate in shared virtual spaces. Meetings become interactive experiences, presentations turn into immersive showcases, and teamwork gains a whole new dimension.</p>
<p>2. <b>Social Interaction and Entertainment</b>: The Metaverse brings people together, transcending geographical boundaries. Attend concerts, events, and conferences virtually, chat with friends in lifelike environments, and explore interactive experiences with a sense of presence like never before.</p>
<p>3. <b>Education and Learning</b>: Learning becomes engaging and immersive in the Metaverse. Imagine students exploring ancient civilizations in virtual history classes or conducting virtual science experiments in a safe and limitless environment.</p>
<p>4. <b>Commerce and Economies</b>: The Metaverse enables the creation of virtual marketplaces and economies. Users can buy, sell, and trade virtual assets, digital real estate, and unique items using blockchain-based technologies, opening up new entrepreneurial opportunities.</p>
<p>5. <b>Gaming and Recreation</b>: Gaming reaches new heights in the Metaverse. Users can dive into captivating virtual worlds, interact with characters, and participate in adrenaline-pumping experiences alongside friends and players worldwide.</p>
<h2>Conclusion</h2>
<p>Joining the Metaverse is more than just adopting a new technology; it signifies embracing a paradigm shift in the way we interact with the digital world. As we embark on this immersive journey, it is crucial to navigate responsibly, ensuring that the Metaverse fosters creativity, inclusivity, and meaningful connections. The future is exciting, and with the Metaverse, a vast world of possibilities awaits those eager to explore beyond the boundaries of the physical realm. The question remains – are you ready to take the leap into the Metaverse?</p>',
                'image' => 'posts/March2018/rU26aWVsZ2zocWGSTE7J.jpg',
                'slug' => 'achieving-your-dreams',
                'meta_description' => 'In this post, you\'ll learn about achieving your dreams by building the SAAS app of your dreams',
                'meta_keywords' => 'saas app, dreams',
                'status' => 'PUBLISHED',
                'featured' => 0,
                'created_at' => '2018-03-26 02:50:18',
                'updated_at' => '2018-03-26 02:15:18',
            ),
        ));
    }
}