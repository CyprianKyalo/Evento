<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        		'name' => 'Admin, Admin',
        		'email' => 'admin@evento.com',
        		'password' => bcrypt('admin'),
        	],
        	[
        		'name' => 'Job, Weldon',
        		'email' => 'job@evento.com',
        		'password' => bcrypt('job'),
        	],
        	[
        		'name' => 'Mark, Jay',
        		'email' => 'mark@evento.com',
        		'password' => bcrypt('mark'),
        	],
        ];

        foreach ($users as $user) {
        	User::create([
        		'name' => $user['name'],
        		'email' => $user['email'],
        		'password' => $user['password']
        	]);
        }
    }
}
