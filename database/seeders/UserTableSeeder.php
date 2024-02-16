<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin123'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Sub Admin',
                'email'          => 'admin@gmail.com',
                'password'       => bcrypt('subad123'),
                'remember_token' => null,
            ],
        ];

        User::insert($user);
    }
}
