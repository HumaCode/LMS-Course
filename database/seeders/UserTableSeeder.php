<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            // admin
            [
                'name'      => 'Administrator', 
                'username'  => 'admin', 
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('123456'),
                'role'      => 'admin',
                'status'    => '1',
            ],
            
            // instructor
            [
                'name'      => 'Instructor', 
                'username'  => 'instructor', 
                'email'     => 'instructor@gmail.com',
                'password'  => Hash::make('123456'),
                'role'      => 'instructor',
                'status'    => '1',
            ],
            
            // user
            [
                'name'      => 'User', 
                'username'  => 'user', 
                'email'     => 'user@gmail.com',
                'password'  => Hash::make('123456'),
                'role'      => 'user',
                'status'    => '1',
            ],

        ]);
    }
}
