<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    public $guarded = [];
}
