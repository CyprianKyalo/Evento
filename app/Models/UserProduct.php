<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_product_id';

    protected $fillable = [
    	'user_id',
    	'product_id',
    	'price',
    	'status',    	
    ];
}
