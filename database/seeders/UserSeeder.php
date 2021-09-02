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
        		'first_name' => 'Administrator',
                'last_name' => 'Admin',
                'username' => 'Admin',
        		'email' => 'admin@evento.com',
        		'password' => bcrypt('admin'),
                'status' => 'Enabled',
                'is_admin' => 1,
        	],
        	[
        		'first_name' => 'Job',
                'last_name' => 'Weldon',
                'username' => 'Jeldy',
        		'email' => 'job@evento.com',
        		'password' => bcrypt('job'),
                'status' => 'Enabled',
                'is_admin' => 0,
        	],
        	[
        		'first_name' => 'Mark',
                'last_name' => 'Jay',
                'username' => 'theBeast',
        		'email' => 'mark@evento.com',
        		'password' => bcrypt('mark'),
                'status' => 'Enabled',
                'is_admin' => 0,
        	],
            [
                'first_name' => 'Fabian',
                'last_name' => 'Kyalo',
                'username' => 'Fabicy',
                'email' => 'fabicy@gmail.com',
                'password' => bcrypt('fabian'),
                'status' => 'Enabled',
                'is_admin' => 0,
            ],
        ];

        foreach ($users as $user) {
        	User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
        		'username' => $user['username'],
        		'email' => $user['email'],
        		'password' => $user['password']
        	]);
        }
    }
}
