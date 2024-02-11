<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'id' => 1, 
                'name' => 'Swindon Town', 
                'email' => 'swindon@gmail.com', 
                'password' => bcrypt('password'),
                'usertype' => 'team',
                'staffid' => NULL,
                'verified' => 'yes',
                'userslug' => 'swindon',
                'sport' => 'football',
                'firstlogin' => NULL,
                'following' => NULL
            ],
            [
                'id' => 2, 
                'name' => 'demo fan', 
                'email' => 'demofan@gmail.com', 
                'password' => bcrypt('password'),
                'usertype' => 'fan',
                'staffid' => NULL,
                'verified' => 'yes',
                'userslug' => 'demofan',
                'sport' => NULL,
                'firstlogin' => NULL,
                'following' => NULL
            ],
            [
                'id' => 3, 
                'name' => 'Demo Staff', 
                'email' => 'demostaff@gmail.com', 
                'password' => bcrypt('password'),
                'usertype' => 'staff',
                'staffid' => '1',
                'verified' => 'yes',
                'userslug' => 'demostaff',
                'sport' => NULL,
                'firstlogin' => NULL,
                'following' => NULL
            ],
        ];

        DB::table('users')->insert($users);
    }
}
