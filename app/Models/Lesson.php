<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'lesson_id', 'id')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc');
    }
}
