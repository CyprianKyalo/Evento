<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
        	[
        		'name' => 'Tents',
        		'description' => 'We can deploy tents at your destination at affordable prices',
                'category' => 'equipment',
        	],
        	[
        		'name' => 'Catering',
        		'description' => 'We make the best dishes and servings for any amount of people',
                'category' => 'service'
        	],
        	[
        		'name' => 'Public Address System',
        		'description' => 'The best PA system; DJ inclusive',
                'category' => 'equipment'
        	],
        ];

        foreach ($products as $product) {
        	Product::create([
        		'name' => $product['name'],
        		'description' => $product['description'],
        		'category' => $product['category'],
        	]);
        }
    }
}
