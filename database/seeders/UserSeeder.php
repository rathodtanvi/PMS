<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'roles_id'=>'1',
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
            'mobile_number'=>'123456789',
            'dob'=>'2000-01-03',
            'joining_date'=>'2021-12-03',
            'gender'=>'0',
            'qualification'=>'work',
            'address'=>'rajkot',
            'status'=>'1',
            
        ]);
        User::create([
            'name'=>'user',
            'roles_id'=>'2',
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('user'),
            'mobile_number'=>'123456789',
            'dob'=>'2000-01-03',
            'joining_date'=>'2021-12-03',
            'gender'=>'1',
            'qualification'=>'work',
            'address'=>'rajkot',
            'status'=>'1',
        ]);
    }
}
