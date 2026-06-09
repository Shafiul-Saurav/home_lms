<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * @property-read \Illuminate\Database\Eloquent\Collection<int, CourseOrder> $courseOrders
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    //Relationship with Permission
    //True or false
    public function hasPermission($permission_slug)
    {
        return $this->role->permissions()->where('permission_slug', $permission_slug)
        ->first() ? true : false;
    }

    //Relationship with Profile
    Public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //Relationship with Testimonial
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    //Relationship with Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Relationship with Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function courseReviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function courseOrders()
    {
        return $this->hasMany(CourseOrder::class);
    }

    public function pdfBookOrders()
    {
        return $this->hasMany(PdfBookOrder::class);
    }

    public function lessonCompletions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    public function isEnrolledInCourse($courseId)
    {
        return $this->courseOrders()
            ->where('course_id', $courseId)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->exists();
    }

    public function isPurchasedPdfBook($bookId)
    {
        return $this->pdfBookOrders()
            ->where('pdf_book_id', $bookId)
            ->where('payment_status', 'Completed')
            ->exists();
    }
}
