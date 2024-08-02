<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Thêm admin
        User::truncate();
        User::create([
            'id' => 1,
            'class_id' => null,
            'code' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'name' => 'Admin',
            'birthday' => '1995-02-28',
            'phone_number' => '0123123123',
            'address' => 'Hà Nội',
            'gender' => 'Nam',
        ]);

        User::create([
            'id' => 2,
            'class_id' => 1,
            'code' => 'TK000002',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('123123123'),
            'name' => 'Thành',
            'birthday' => '1995-02-28',
            'phone_number' => '0123123122',
            'address' => 'Hà Nội',
            'gender' => 'Nam',
        ]);

        User::create([
            'id' => 3,
            'class_id' => 1,
            'code' => 'TK000002',
            'email' => 'student@gmail.com',
            'password' => bcrypt('123123123'),
            'name' => 'Thành',
            'birthday' => '1995-02-28',
            'phone_number' => '0123123122',
            'address' => 'Hà Nội',
            'gender' => 'Nam',
        ]);
    }
}
