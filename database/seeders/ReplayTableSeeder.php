<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\DataRow;

// models
use App\Models\Course;
use App\Models\Download;
use App\Models\Reservation;
use App\Models\Schedule;

// policies
use App\Policies\CoursePolicy;
use App\Policies\DownloadPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\SchedulePolicy;

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

        /***********************************************************************
         * COURSES
         **********************************************************************/
        $courses_bread = $this->createBread(
            "courses",
            "Course",
            "Courses",
            Course::class,
            CoursePolicy::class,
            'voyager-certificate',
            'id',
            'title'
        );
        $this->createBreadRows($courses_bread, Course::$BREAD_FIELDS, Course::$BREAD_PERMISSIONS);
        $this->createRelationships($courses_bread, Course::$BREAD_RELATIONSHIPS);
        $this->createPermissions("courses");

        /***********************************************************************
         * DOWNLOADS
         **********************************************************************/
        $downloads_bread = $this->createBread(
            "downloads",
            "Download",
            "Downloads",
            Download::class,
            DownloadPolicy::class,
            'voyager-cloud-download',
            'id',
            'file'
        );
        $this->createBreadRows($downloads_bread, Download::$BREAD_FIELDS, Download::$BREAD_PERMISSIONS);
        $this->createRelationships($downloads_bread, Download::$BREAD_RELATIONSHIPS);
        $this->createPermissions("downloads");

        /***********************************************************************
         * SCHEDULES
         **********************************************************************/
        $schedules_bread = $this->createBread(
            "schedules",
            "Schedule",
            "Schedules",
            Schedule::class,
            SchedulePolicy::class,
            'voyager-calendar',
            'id',
            'course_id'
        );
        $this->createBreadRows($schedules_bread, Schedule::$BREAD_FIELDS, Schedule::$BREAD_PERMISSIONS);
        $this->createRelationships($schedules_bread, Schedule::$BREAD_RELATIONSHIPS);
        $this->createPermissions("schedules");

        /***********************************************************************
         * RESERVATIONS
         **********************************************************************/
        $reservations_bread = $this->createBread(
            "reservations",
            "Reservation",
            "Reservations",
            Reservation::class,
            ReservationPolicy::class,
            'voyager-check-circle',
            'id',
            'course_id'
        );
        $this->createBreadRows($reservations_bread, Reservation::$BREAD_FIELDS, Reservation::$BREAD_PERMISSIONS);
        $this->createRelationships($reservations_bread, Reservation::$BREAD_RELATIONSHIPS);
        $this->createPermissions("reservations");
    }

    /**
     * Create or update a BREAD `data_types` entry.
     * 
     * @return TCG\Voyager\Models\DataType
     */
    protected function createBread($slug, $singular, $plural, $model, $policy, $icon, $id_field, $search_field = null, $order_direction = 'desc')
    {
        return DataType::updateOrCreate(
            ['slug' => $slug],
            [
                'name' => $slug,
                'slug' => $slug,
                'display_name_singular' => $singular,
                'display_name_plural' => $plural,
                'icon' => $icon,
                'model_name' => $model,
                'policy_name' => $policy,
                'controller' => '',
                'description' => '',
                'generate_permissions' => true,
                'server_side' => true,
                'details' => [
                    'order_column' => $id_field,
                    'order_display_column' => null,
                    'order_direction' => $order_direction,
                    'default_search_key' => $search_field ? $search_field : $id_field,
                ],
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
            $role = Voyager::model('Role')->where('name', 'admin')->firstOrFail();
            $permissions = Voyager::model('Permission')->where(['table_name' => $table_name])->get()->pluck('id')->all();

            // Grant all privileges to admin
            $role->permissions()->attach($permissions);

            // all roles that are not admin and cancelled
            $roles = Voyager::model('Role')->whereNotIn('name', [
                'admin',
                'cancelled',
            ])->get();

            // Assign browse capacity to other roles
            foreach ($roles as $role) :
                $grant_browsing = Voyager::model('Permission')->where([
                    'key' => 'browse_' . $table_name,
                ])->get()->pluck('id')->all();

                // Grant BROWSE privileges to end-users
                $role->permissions()->attach($grant_browsing);
            endforeach;
        }
    }
}
