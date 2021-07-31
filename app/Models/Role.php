<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    public $guarded = [];

    public function users() {
    	return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }
}
