<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookSubcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function bookCategory()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'book_subcategory_id');
    }
}
