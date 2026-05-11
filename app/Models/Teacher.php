<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['hire_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teachers', 'teacher_id', 'course_id')
                    ->withPivot('is_active')
                    ->withTimestamps();
    }

    public function averageRating()
    {
        $courseIds = $this->courses()->pluck('courses.id');
        return round(CourseReview::whereIn('course_id', $courseIds)->where('is_approved', 1)->avg('rating'), 1) ?: 0;
    }

    public function reviewCount()
    {
        $courseIds = $this->courses()->pluck('courses.id');
        return CourseReview::whereIn('course_id', $courseIds)->where('is_approved', 1)->count();
    }
}
