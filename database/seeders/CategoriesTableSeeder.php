<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        $categories = [
            0 => $this->createCategory('blog', 'Blog', [
                0 => $this->createCategory('news', 'News'),
                1 => $this->createCategory('team-update', 'Team Updates'),
                2 => $this->createCategory('team-stories', 'Team Stories'),
            ]),
            1 => $this->createCategory('courses', 'Courses', [
                0 => $this->createCategory('academic', 'Academic'),
                1 => $this->createCategory('academic-test-preparation', 'Academic Test Preparation'),
                2 => $this->createCategory('business', 'Business'),
                3 => $this->createCategory('creative-arts', 'Creative Arts'),
                4 => $this->createCategory('health-and-wellness', 'Health & Wellness'),
                5 => $this->createCategory('hobby-and-interest-based', 'Hobbies & Interest-Based'),
                6 => $this->createCategory('industry-specific', 'Industry-Specific'),
                7 => $this->createCategory('language', 'Language'),
                8 => $this->createCategory('online-degree-program', 'Online Degree Program'),
                9 => $this->createCategory('personal-development', 'Personal Development'),
                10 => $this->createCategory('professional-development', 'Professional Development'),
                11 => $this->createCategory('skill-based', 'Skill-Based'),
                12 => $this->createCategory('technology', 'Technology'),
            ]),
        ];

        foreach ($categories as $ix => $category):
            $category["order"] = $ix+1;
            $main_id = \DB::table('categories')->insertGetId(
                \Arr::except($category, ['children'])
            );

            foreach ($category['children'] as $cx => $sub_category):
                $sub_category['order'] = $cx+1;
                $sub_category['parent_id'] = $main_id;
                $sub_id = \DB::table('categories')->insertGetId(
                    \Arr::except($sub_category, ['children'])
                );
            endforeach;
        endforeach;
    }

    protected function createCategory($slug, $name, array $children = []): array {
        return [
            'name' => $name,
            'slug' => $slug,
            'created_at' => now(),
            'updated_at' => now(),
            'children' => $children,
        ];
    }
}