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
        'status',
        'image',
        'is_admin',
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

    // public function product() {
    //     return $this->belongsTo(Product::class);
    // }
    public function product() {
        return $this->hasMany('App\Models\Product');
    }

    // public function hiredproduct() {
    //     return $this->hasMany(HiredProduct::class);
    // }
     public function hiredproduct() {
        return $this->hasMany('App\Models\Product');
    }

    public function userproduct() {
        return $this->hasMany(UserProduct::class);
    }

    public function role() {
        return $this->belongsToMany(Role::class);
    }

    public function suspend($crud = false) {
        return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }
}
