<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'gender',
        'telephone',
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
        'email_verified_at' => 'datetime',
    ];


    public function progress()
    {
        return $this->hasmany(Progress::class, 'id','id');
    }
    public function workoutPlans()
    {
        return $this->hasMany(WorkoutPlan::class, 'id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'coach_students', 'coach_id', 'student_id');
    }

    public function coaches()
    {
        return $this->belongsToMany(User::class, 'coach_students', 'student_id', 'coach_id');
    }
}
