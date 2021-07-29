<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProduct;

class UserProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userProducts = [
        	[
        		'user_id' => 1,
        		'product_id' => 1,
        		'price' => 40,
        		'status' => 'toHire', 
        	],
        	[
        		'user_id' => 2,
        		'product_id' => 2,
        		'price' => 40,
        		'status' => 'toHire', 
        	],
        	[
        		'user_id' => 3,
        		'product_id' => 3,
        		'price' => 40,
        		'status' => 'toHire', 
        	],
        ];

        foreach ($userProducts as $userProduct) {
        	UserProduct::create([
        		'user_id' => $userProduct['user_id'],
        		'product_id' => $userProduct['product_id'],
        		'price' => $userProduct['price'],
        		'status' => $userProduct['status'],
        	]);
        }
    }
}
