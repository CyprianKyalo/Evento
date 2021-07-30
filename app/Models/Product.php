<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    //use SoftDeletes;

    protected $primaryKey = 'product_id';

    protected $fillable = [
    	'name',
    	'description',
    	'category',   
    	'status', 	
    ];
}
