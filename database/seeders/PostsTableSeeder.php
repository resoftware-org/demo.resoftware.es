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
                'category_id' => 2, // "News"
                'title' => 'The e-Learning Revolution: Unleashing the Power of Online Courses',
                'seo_title' => 'The e-Learning Revolution: Unleashing the Power of Online Courses',
                'excerpt' => NULL,
                'body' => '<p>In recent years, the landscape of education has undergone a transformative shift with the rise of online courses and e-learning platforms. This educational revolution has opened up a world of opportunities for both learners and educators, redefining traditional teaching methods and expanding access to knowledge like never before. From specialized skills to academic subjects, teaching online has become a thriving industry, empowering individuals across the globe to learn at their own pace, on their own terms.</p>
<h2>The rise of eLearning platforms</h2>
<p>The internet has become a vast repository of information, and e-learning platforms have emerged to harness this digital wealth and transform it into interactive, engaging, and accessible educational experiences. These platforms offer a wide range of courses, catering to diverse interests and fields of study. Whether you\'re looking to learn a new language, master coding skills, or pursue a degree from a renowned university, there\'s an online course tailored to your needs.</p>
<p>For educators, teaching online offers a host of advantages that traditional classroom settings may not provide. Here are some key benefits:</p>
<p>1. Global Reach: With online courses, educators can reach learners worldwide, breaking down geographical barriers and creating a truly global classroom. This not only widens the audience but also enriches the learning experience with diverse perspectives.</p>
<p>2. Flexibility and Convenience: Online teaching allows instructors to create flexible learning schedules, accommodating learners with busy lifestyles or time zone differences. Students can access course materials and lectures at their convenience, facilitating self-paced learning.</p>
<p>3. Personalization: E-learning platforms often provide tools for personalized learning, enabling educators to tailor their teaching methods and materials to suit individual student needs and learning styles.</p>
<p>4. Cost-Effectiveness: Compared to traditional brick-and-mortar institutions, online courses can be more cost-effective for both educators and learners. There are reduced expenses related to physical infrastructure, and students save on commuting and accommodation costs.</p>
<p>5. Real-Time Feedback: Online platforms offer instant feedback and assessment tools, allowing instructors to monitor student progress and identify areas that require more attention.</p>
                ',
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
                'category_id' => 2, // "News"
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