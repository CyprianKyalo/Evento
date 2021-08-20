<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable implements MustVerifyEmail 
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function hiredproduct() {
        return $this->hasMany(HiredProduct::class);
    }

    public function userproduct() {
        return $this->hasMany(UserProduct::class);
    }

    public function role() {
        return $this->belongsToMany(Role::class);
    }
}
