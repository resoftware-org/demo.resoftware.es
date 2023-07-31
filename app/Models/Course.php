<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Wave\Category;

class Course extends Model
{
    /**
     * Table specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    public static $BREAD_FIELDS = [
        0 => ['field' => 'id', 'type' => 'hidden', 'display_name' => 'Id', 'details' => null, 'order' => 1],
        1 => ['field' => 'author_id', 'type' => 'number', 'display_name' => 'Author', 'details' => null, 'order' => 2],
        2 => ['field' => 'category_id', 'type' => 'number', 'display_name' => 'Category', 'details' => null, 'order' => 3],
        3 => ['field' => 'slug', 'type' => 'text', 'display_name' => 'Slug', 'order' => 4, 'details' => [
            "slugify" => [
                "origin" => "title",
                "forceUpdate" => true
            ]
        ]],
        4 => ['field' => 'title', 'type' => 'text', 'display_name' => 'Name', 'details' => null, 'order' => 5],

        // order = 6 = course_belongsto_owner
        // order = 7 = course_belongsto_category

        5 => ['field' => 'description', 'type' => 'rich_text_box', 'display_name' => 'Description (optional)', 'details' => null, 'order' => 8],
        6 => ['field' => 'excerpt', 'type' => 'text_area', 'display_name' => 'Excerpt (optional)', 'details' => null, 'order' => 9],
        7 => ['field' => 'image', 'type' => 'image', 'display_name' => 'Featured Image', 'order' => 10, 'details' => [
            "resize" => [
                "width" => "1000",
                "height" => "null"
            ],
            "quality" => "70%",
            "upsize" => true,
            "thumbnails" => [
                ["name" => "medium", "scale" => "50%"],
                ["name" => "small", "scale" => "25%"],
                ["name" => "cropped", "crop" => ["width" => "300", "height" => "250"]],
            ]
        ]],

        // meta

        8 => ['field' => 'meta_description', 'type' => 'text_area', 'display_name' => 'meta_description', 'details' => null, 'order' => 11],
        9 => ['field' => 'meta_keywords', 'type' => 'text', 'display_name' => 'meta_keywords', 'details' => '', 'order' => 12],
        10=> ['field' => 'status', 'type' => 'select_dropdown', 'display_name' => 'Status', 'order' => 13, 'details' => [
            "default" => "DRAFT",
            "options" => [
                "DRAFT" => "Draft",
                "PUBLISHED" => "Published",
                "PENDING" => "Pending"
            ],
        ]],

        // dates

        11=> ['field' => 'created_at', 'type' => 'timestamp', 'display_name' => 'created_at', 'details' => null, 'order' => 14],
        12=> ['field' => 'updated_at', 'type' => 'timestamp', 'display_name' => 'updated_at', 'details' => null, 'order' => 15],
    ];

    /**
     * Permissions specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_PERMISSIONS = [
        "id"                => ['required' => 1, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "author_id"         => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "category_id"       => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 0],
        "slug"              => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "title"             => ['required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "description"       => ['required' => 0, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "excerpt"           => ['required' => 0, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "image"             => ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "meta_description"  => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "meta_keywords"     => ['required' => 1, 'browse' => 0, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "status"            => ['required' => 1, 'browse' => 1, 'read' => 1, 'edit' => 1, 'add' => 1, 'delete' => 1],
        "created_at"        => ['required' => 0, 'browse' => 1, 'read' => 1, 'edit' => 0, 'add' => 0, 'delete' => 0],
        "updated_at"        => ['required' => 0, 'browse' => 0, 'read' => 0, 'edit' => 0, 'add' => 0, 'delete' => 0],
    ];

    /**
     * Relationships specification for BREAD management (voyager)
     * @see database/seeders/ReplayTableSeeder
     * @var array
     */
    static public $BREAD_RELATIONSHIPS = [
        ['field' => 'course_belongsto_owner', 'display_name' => 'Owner', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'App\\Models\\User', 'table' => 'users', 'type'  => 'belongsTo', 'column' => 'author_id', 'key' => 'id',
            'label' => 'email', 'pivot_table' => 'users', 'pivot' => false,
        ], 'order' => 6],
        ['field' => 'course_belongsto_category', 'display_name' => 'Category', 'type' => 'relationship', 'required' => true, 'browse' => true, 'read' => true, 'edit' => true, 'add' => true, 'delete' => false, 'details' => [
            'model' => 'Wave\\Category', 'table' => 'categories', 'type'  => 'belongsTo', 'column' => 'category_id', 'key' => 'id',
            'label' => 'name', 'pivot_table' => 'categories', 'pivot' => false,
        ], 'order' => 7],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'slug',
        'title',
        'description',
        'excerpt',
        'image',
        'meta_description',
        'meta_keywords',
        'status',
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     *
     */
    public function downloads()
    {
        return $this->hasMany(Download::class, 'course_id', 'id');
    }

    /**
     *
     */
    public function scopeFeatured(Builder $query)
    {
        return $query->where("courses.featured", true);
    }

    /**
     *
     */
    public function scopeByTerm(Builder $query, string $term)
    {
        return $query->where("courses.title", 'like', '%' . $term . '%');
    }
}
