<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'progresses';

    // The primary key associated with the table
    protected $primaryKey = 'progress_id';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = true;

    // The "type" of the auto-incrementing ID
    protected $keyType = 'int';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'workout_set',
        'workout_duration',
        'calories_burn',
        'id',
        'status'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
