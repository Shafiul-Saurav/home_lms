<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Relationship with Postcategory
    public function postCategory()
    {
        return $this->belongsTo(Postcategory::class, 'category_id', 'id');
    }

    //Relationship with Comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    // public function paginatedComments($perPage = 1)
    // {
    //     return $this->comments()->where('parent_id', null)->paginate($perPage);
    // }
}
