<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Wave\User as Authenticatable;

use App\Models\Course;
use App\Models\Reservation;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * A list of IDs mapped to their respective roles' slug.
     *
     * @static
     * @access public
     * @var array
     */
    public static array $ROLES = [
        "admin"   => 1,
        "trial"   => 2, // level 0
        "starter" => 3, // level 1
        "mentor"  => 4, // level 2
        "college" => 5, // level 3
        "cancelled" => 6,
    ];

    /**
     * A list of IDs mapped to their respective plans' slug.
     *
     * @static
     * @access public
     * @var array
     */
    public static array $PLANS = [
        "starter" => 1,
        "mentor"  => 2,
        "college" => 3,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'verification_code',
        'verified',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    /**
     *
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'author_id', 'id');
    }

    /**
     *
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    /**
     *
     */
    public function attendances()
    {
        return $this->hasManyThrough(
            Course::class,
            Reservation::class,
            'user_id', // key to resolve reservations
            'id', // key to resolve courses
            'id', // local key (user id)
            'course_id' // foreign key to resolve courses
        );
    }

    /**
     *
     */
    public function distinct_courses_taken()
    {
        return $this->attendances()
            ->distinct()
            ->get();
    }

    /**
     *
     */
    public function getTitledNameAttribute()
    {
        $title = $this->profile("title");
        if (!empty($title)) $title .= " ";
        return sprintf("%s%s", $title, $this->name);
    }
}
