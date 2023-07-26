<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Download extends Model
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
        4 => ['field' => 'title', 'type' => 'text', 'display_name' => 'Name', 'details' => null, 'order' => 4],

        // order = 5 = download_belongsto_owner
        // order = 6 = download_belongsto_course

        5 => ['field' => 'excerpt', 'type' => 'text_area', 'display_name' => 'Excerpt (optional)', 'details' => null, 'order' => 7],
        6 => ['field' => 'file', 'type' => 'file', 'display_name' => 'Downloadable file', 'details' => null, 'order' => 8],

        // dates
        7 => ['field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'details' => null, 'order' => 9],
        8 => ['field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'details' => null, 'order' => 10],
    ];

    /**
     * Permissions specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_PERMISSIONS = [
        "id"        => ['required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "author_id" => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "course_id" => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "title"     => ['required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "excerpt"   => ['required' => 0, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "file"      => ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "created_at"=> ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "updated_at"=> ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
    ];

    /**
     * Relationships specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_RELATIONSHIPS = [
        ['field' => 'download_belongsto_owner', 'display_name' => 'Owner', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\User', 'table' => 'users', 'type'  => 'belongsTo', 'column' => 'author_id', 'key' => 'id',
            'label' => 'email', 'pivot_table' => 'users', 'pivot' => false,
        ], 'order' => 5],
        ['field' => 'download_belongsto_course', 'display_name' => 'Course', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\Course', 'table' => 'courses', 'type'  => 'belongsTo', 'column' => 'course_id', 'key' => 'id',
            'label' => 'title', 'pivot_table' => 'courses', 'pivot' => false,
        ], 'order' => 6],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'course_id',
        'title',
        'excerpt',
        'file',
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
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     *
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
