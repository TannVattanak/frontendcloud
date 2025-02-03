<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'workoutplans';

    // The primary key associated with the table
    protected $primaryKey = 'workoutplan_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The "type" of the auto-incrementing ID
    protected $keyType = 'int';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'course_name',
        'course_type',
        'schedule',
        'duration',
        'requirement',
        'price',
        'course_description',
        'course_image',// Adding the course_image column
        'id'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'workoutplan_id', 'workoutplan_id');
    }
}
