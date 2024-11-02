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

    //Relationship with Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    //Relationship with Testimonial
    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}
