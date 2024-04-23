<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
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
        $isAdminExist = DB::table('admins')->where(['email' => "admin@yopmail.com"])->count();
        if(!$isAdminExist){
            DB::table('admins')->insert([
                'full_name' => 'Admin',
                'email' => 'admin@yopmail.com',
                'phone_number' => '123456789',
                'password' => Hash::make('admin@123')
            ]);
            DB::table('users')->insert([
                [
                    'full_name' => 'laksh',
                    'email' => 'laksh@yopmail.com',
                    'phone_number' => '1223456789',
                    'password' => Hash::make('admin@123')
                    ],
                    [
                        'full_name' => 'money',
                        'email' => 'sssingh70875@gmail.com',
                        'phone_number' => '1223456789',
                        'password' => Hash::make('admin@123')
                        ]
                    ]);
        }
    }
}
