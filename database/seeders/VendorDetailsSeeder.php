<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorDetails;

class VendorDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorDetails = [
        	[
        		'user_id' => 4,
        		'location' => 'Nairobi',
        		'about' => 'My sole purpose is to Solve your Problem and to satisfy your every need in low price but high quality work in very short amount of time.

					- I will work until you are satisfied.
					- Daily updates will be provided on the work done.
					- 100% satisfaction guaranteed or Money Back',
        		'pnumber' => '0738000000', 
        	]
        ];

        foreach ($vendorDetails as $vendorDetail) {
        	VendorDetails::create([
        		'user_id' => $vendorDetail['user_id'],
        		'location' => $vendorDetail['location'],
        		'about' => $vendorDetail['about'],
        		'pnumber' => $vendorDetail['pnumber'],
        	]);
        }
    }
}
