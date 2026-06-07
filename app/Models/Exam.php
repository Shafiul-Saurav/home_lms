<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ExamCategory::class, 'category_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question')->withPivot('order_num')->orderBy('pivot_order_num');
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
}
