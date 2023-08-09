<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Models\User;
use App\Models\Course;

class Schedule extends Model
{
    /**
     * Table specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    public static $BREAD_FIELDS = [
        0 => ['field' => 'id', 'type' => 'hidden', 'display_name' => 'Id', 'details' => null, 'order' => 1],
        1 => ['field' => 'author_id', 'type' => 'text', 'display_name' => 'Author', 'details' => null, 'order' => 2],
        2 => ['field' => 'course_id', 'type' => 'text', 'display_name' => 'Course', 'details' => null, 'order' => 3],

        // order = 4 = schedule_belongsto_owner
        // order = 5 = schedule_belongsto_course

        3 => ['field' => 'meeting_url', 'type' => 'text', 'display_name' => 'Meeting URL', 'details' => null, 'order' => 6],
        4 => ['field' => 'meeting_password', 'type' => 'password', 'display_name' => 'Meeting Password (optional)', 'details' => null, 'order' => 7],
        5 => ['field' => 'course_opens_at', 'type' => 'timestamp', 'display_name' => 'Room opening at', 'details' => null, 'order' => 8],
        6 => ['field' => 'course_starts_at', 'type' => 'timestamp', 'display_name' => 'Course starts at', 'details' => null, 'order' => 9],
        7 => ['field' => 'course_ends_at', 'type' => 'timestamp', 'display_name' => 'Course ends at (optional)', 'details' => null, 'order' => 10],

        // dates
        8 => ['field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'details' => null, 'order' => 11],
        9 => ['field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'details' => null, 'order' => 12],
    ];

    /**
     * Permissions specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_PERMISSIONS = [
        "id"            => ['required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 1],
        "author_id"     => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "course_id"     => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "meeting_url"   => ['required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "meeting_password"  => ['required' => 0, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "course_opens_at"   => ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "course_starts_at"  => ['required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "course_ends_at"=> ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "created_at"    => ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "updated_at"    => ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
    ];

    /**
     * Relationships specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_RELATIONSHIPS = [
        ['field' => 'schedule_belongsto_owner', 'display_name' => 'Owner', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\User', 'table' => 'users', 'type'  => 'belongsTo', 'column' => 'author_id', 'key' => 'id',
            'label' => 'email', 'pivot_table' => 'users', 'pivot' => false,
        ], 'order' => 4],
        ['field' => 'schedule_belongsto_course', 'display_name' => 'Course', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\Course', 'table' => 'courses', 'type'  => 'belongsTo', 'column' => 'course_id', 'key' => 'id',
            'label' => 'title', 'pivot_table' => 'courses', 'pivot' => false,
        ], 'order' => 5],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'course_id',
        'meeting_url',
        'meeting_password',
        'course_opens_at',
        'course_starts_at',
        'course_ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'meeting_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'course_opens_at' => 'datetime',
        'course_starts_at' => 'datetime',
        'course_ends_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     *
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     *
     */
    public function scopeByMonth(Builder $query, string $month)
    {
        return $query->whereRaw(
            "extract(month from schedules.course_opens_at) = " . $month,
        );
    }

    /**
     *
     */
    public function scopeByAuthor(Builder $query, User $user)
    {
        return $query->where("schedules.author_id", $user->id);
    }

    /**
     *
     */
    public function scopeWithReservation(Builder $query, User $user)
    {
        return $query
            ->join("reservations", "reservations.schedule_id", "schedules.id")
            ->where("reservations.user_id", $user->id);
    }
}
