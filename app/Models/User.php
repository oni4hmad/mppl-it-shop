<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'user_type',
        'nomor_hp',
        'kota',
        'kode_pos',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Roles middleware
     */
    public function isCustomer() {
        return $this->user_type == UserType::CUSTOMER;
    }

    public function isAdmin() {
        return $this->user_type == UserType::ADMINISTRATOR;
    }

    public function isTechnician() {
        return $this->user_type == UserType::TECHNICIAN;
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function profile_picture()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
