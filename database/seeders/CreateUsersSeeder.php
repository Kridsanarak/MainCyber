<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'isAdmin' => '1',
                'password' => bcrypt('1234')

            ],
            [
                'name' => 'Adminrakna',
                'email' => 'adminrakna@admin.com',
                'isAdmin' => '1',
                'password' => bcrypt('$erver@dmin')

            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'isAdmin' => '0',
                'password' => bcrypt('1234')
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}

