<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resources';

    protected $primaryKey = 'resource_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'type',
        'subtitle',
        'author',
        'img_cover',
        'paragraph1',
        'paragraph1_img',
        'paragraph2',
        'paragraph2_img',
        'exercise_type',
        'exercise_muscle',
        'exercise_equipment',
        'exercise_difficulty',
        'exercise_description',
    ];
}
