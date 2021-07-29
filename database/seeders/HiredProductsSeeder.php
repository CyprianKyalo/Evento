<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HiredProduct;

class HiredProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hiredProducts = [
        	[
        		'user_id' => 1,
        		'product_id' => 3,
        		'duration' => '5 hours',
        	],
        	[
        		'user_id' => 2,
        		'product_id' => 1,
        		'duration' => '1 day',
        	],
        	[
        		'user_id' => 3,
        		'product_id' => 2,
        		'duration' => '2 days',
        	],
        ];

        foreach ($hiredProducts as $hiredProduct) {
        	HiredProduct::create([
        		'user_id' => $hiredProduct['user_id'],
        		'product_id' => $hiredProduct['product_id'],
        		'duration' => $hiredProduct['duration'],
        	]);
        }
    }
}
