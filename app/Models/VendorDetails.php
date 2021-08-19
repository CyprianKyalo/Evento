<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'vendor_det_id';

    protected $fillable = [
    	'user_id',
    	'location',
    	'about',
    	'pnumber',    	
    ];

}
