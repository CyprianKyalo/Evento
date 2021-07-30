<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiredProduct extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $primaryKey = 'hire_id';

    protected $fillable = [
    	'user_id',
    	'product_id',
    	'hired_at',
    	'duration',
    	'hire_ended_at',
    	'status',    	
    ];
}
