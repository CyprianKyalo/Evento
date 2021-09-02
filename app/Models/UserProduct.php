<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
	use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $primaryKey = 'user_product_id';

    protected $fillable = [
    	'user_id',
    	'product_id',
    	'price',
    	'status',    	
    ];

    // public function user() {
    // 	return $this->belongsTo(User::class, 'id', 'user_product_id');
    // }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id');
    }

    // public function hiredproduct() {
    //     return $this->belongsToMany('App\Models\HiredProduct', 'products', 'product_id', 'product_id');
    // }

}
