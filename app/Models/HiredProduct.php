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
        'total_price',
    	'status',    	
    ];

    // public function user() {
    // 	return $this->belongsTo(User::class, 'hire_id', 'id');
    // }

    //  public function user() {
    //     return $this->belongsTo('App\Models\User', 'user_id');
    // }

    // // public function product() {
    // // 	return $this->belongsTo(product::class, 'hire_id', 'product_id');
    // // }

    // public function product() {
    //     return $this->belongsTo('App\Models\Product', 'product_id');
    // }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function userproduct() {
    //     return $this->belongsToMany('App\Models\UserProduct', 'products', 'product_id', 'product_id');
    // }
}
