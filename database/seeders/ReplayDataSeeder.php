<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Wave\Category;

// models
use App\Models\Course;
use App\Models\Download;

class ReplayDataSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // first truncate
        \DB::table('downloads')->delete();
        \DB::table('courses')->delete();

        $cat_creative = Category::where("slug", "creative-arts")->first();

        /***********************************************************************
         * COURSES
         **********************************************************************/
        $example_01 = $this->createCourse(
            $cat_creative,
            "Math for Beginners",
            "Embark on a captivating journey into the world of numbers and "
            . "equations with our comprehensive online mathematics course. "
            . "Master essential concepts, problem-solving techniques, and "
            . "real-life applications in a user-friendly, interactive learning "
            . "environment. Whether you're a beginner or looking to sharpen your "
            . "skills, our expert instructors will guide you every step of the "
            . "way. Join now and discover the beauty and power of mathematics!",
            "courses/July2023/online-course-1.png"
        );

        $example_02 = $this->createCourse(
            $cat_creative,
            "Science for Beginners",
            "Unleash your curiosity and explore the wonders of science through "
            . "our engaging online course. Dive into captivating topics, conduct "
            . "exciting experiments, and unravel the mysteries of the universe. "
            . "Led by passionate instructors, this course will spark your interest "
            . "in biology, chemistry, physics, and more. Whether you're a budding "
            . "scientist or simply curious about the world around you, our interactive "
            . "lessons and hands-on activities will ignite your love for learning. "
            . "Join us today and embark on a thrilling scientific adventure!",
            "courses/July2023/online-course-2.png"
        );

        $example_03 = $this->createCourse(
            $cat_creative,
            "Biology for Beginners",
            "Embark on a fascinating journey into the living world with our dynamic "
            . "online biology course. Delve into the intricacies of life, from cells "
            . "to ecosystems, as we explore genetics, evolution, and physiology. Led "
            . "by expert biologists, this course offers a blend of engaging lectures, "
            . "interactive quizzes, and hands-on experiments to deepen your understanding. "
            . "Whether you're a student pursuing a career in life sciences or simply curious "
            . "about the natural world, our course will nurture your passion for biology. "
            . "Enroll now and uncover the secrets of life!",
            "courses/July2023/online-course-3.png"
        );

    }

    /**
     * Create or update a BREAD `data_types` entry.
     * 
     * @return TCG\Voyager\Models\DataType
     */
    protected function createCourse(
        Category $category,
        string $title,
        string $description,
        string $image,
    )
    {
        $slug = \Str::slug($title);
        return Course::updateOrCreate(
            ['slug' => $slug],
            [
                'author_id' => 1,
                'category_id' => $category->id,
                'status' => 'PUBLISHED',
                'title' => $title,
                'seo_title' => $title,
                'excerpt' => \Str::excerpt($description),
                'description' => $description,
                'image' => $image,
                'meta_description' => $description,
                'featured' => false,
            ]);
    }

    /**
     * Create or update a BREAD `data_rows` entries.
     * 
     * @return TCG\Voyager\Models\DataType
     */
    protected function createBreadRows($bread, $rows, $permissions)
    {
        // delete all rows (! also relationships)
        DataRow::where('data_type_id', $bread->id)->delete();

        // then add new config
        foreach ($rows as $ix => &$spec):
            $spec['display_name'] = ucwords(str_replace('_', ' ', $spec['field']));
            $spec['details'] = empty($spec['details']) ? (object) [] : $spec['details'];

            // add permissions (required + BREAD)
            $spec = array_merge($spec, $permissions[$spec['field']]);

            DataRow::updateOrCreate(
                ['data_type_id' => $bread->id, 'field' => $spec['field']],
                \Arr::except($spec, ['field'])
            );
        endforeach;
    }

    /**
     * Create or update a BREAD `relationships` entries.
     * 
     * @return TCG\Voyager\Models\DataType
     */
    protected function createRelationships($bread, $relationships)
    {
        // delete all relationships (if any)
        DataRow::where('data_type_id', $bread->id)
            ->where('type', 'relationship')->delete();

        // then add new config
        foreach ($relationships as $ix => &$spec):
            //$spec['display_name'] = ucwords(str_replace('_', ' ', $spec['field']));
            $spec['details'] = empty($spec['details']) ? (object) [] : $spec['details'];
            DataRow::updateOrCreate(
                ['data_type_id' => $bread->id, 'field' => $spec['field']],
                \Arr::except($spec, ['field'])
            );
        endforeach;
    }

    /**
     * Create or update a BREAD `permissions` entries.
     */
    protected function createPermissions($table_name)
    {
        $exists = Permission::where('key', 'browse_' . $table_name)->exists();

        Permission::firstOrCreate(['key' => 'browse_'.$table_name, 'table_name' => $table_name]);
        Permission::firstOrCreate(['key' => 'read_'.$table_name, 'table_name' => $table_name]);
        Permission::firstOrCreate(['key' => 'edit_'.$table_name, 'table_name' => $table_name]);
        Permission::firstOrCreate(['key' => 'add_'.$table_name, 'table_name' => $table_name]);
        Permission::firstOrCreate(['key' => 'delete_'.$table_name, 'table_name' => $table_name]);

        if (!$exists) { // only once
            $role = Voyager::model('Role')->where('name', config('voyager.bread.default_role'))->firstOrFail();
            $permissions = Voyager::model('Permission')->where(['table_name' => $table_name])->get()->pluck('id')->all();

            // Assign permission to default role
            $role->permissions()->attach($permissions);
        }
    }
}
