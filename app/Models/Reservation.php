<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Models\User;
use App\Models\Course;
use App\Models\Schedule;

class Reservation extends Model
{
    /**
     * Table specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    public static $BREAD_FIELDS = [
        0 => ['field' => 'id', 'type' => 'hidden', 'display_name' => 'Id', 'details' => null, 'order' => 1],
        1 => ['field' => 'user_id', 'type' => 'text', 'display_name' => 'Author', 'details' => null, 'order' => 2],
        2 => ['field' => 'course_id', 'type' => 'text', 'display_name' => 'Course', 'details' => null, 'order' => 3],
        3 => ['field' => 'schedule_id', 'type' => 'text', 'display_name' => 'Schedule', 'details' => null, 'order' => 4],

        // order = 5 = reservation_belongsto_owner
        // order = 6 = reservation_belongsto_course
        // order = 7 = reservation_hasone_schedule

        // dates
        4 => ['field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'details' => null, 'order' => 8],
        5 => ['field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'details' => null, 'order' => 9],
    ];

    /**
     * Permissions specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_PERMISSIONS = [
        "id"            => ['required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 1],
        "user_id"       => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "course_id"     => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "schedule_id"   => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "created_at"    => ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "updated_at"    => ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
    ];

    /**
     * Relationships specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_RELATIONSHIPS = [
        ['field' => 'reservation_belongsto_owner', 'display_name' => 'Owner', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\User', 'table' => 'users', 'type'  => 'belongsTo', 'column' => 'user_id', 'key' => 'id',
            'label' => 'email', 'pivot_table' => 'users', 'pivot' => false,
        ], 'order' => 5],
        ['field' => 'reservation_belongsto_course', 'display_name' => 'Course', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\Course', 'table' => 'courses', 'type'  => 'belongsTo', 'column' => 'course_id', 'key' => 'id',
            'label' => 'title', 'pivot_table' => 'courses', 'pivot' => false,
        ], 'order' => 6],
        ['field' => 'reservation_hasone_schedule', 'display_name' => 'Schedule', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\Schedule', 'table' => 'schedules', 'type'  => 'belongsTo', 'column' => 'schedule_id', 'key' => 'id',
            'label' => 'course_starts_at', 'pivot_table' => 'schedules', 'pivot' => false,
        ], 'order' => 7],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'schedule_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     *
     */
    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }

    /**
     *
     */
    public function scopeByUserAndMonth(Builder $query, User $user, string $month)
    {
        return $query
            ->join("schedules", "schedules.id", "reservations.schedule_id")
            ->whereRaw(
                "extract(month from schedules.course_opens_at) = " . $month,
            )
            ->where('reservations.user_id', $user->id);
    }
}
