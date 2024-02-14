<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 38540; $i <= 961461; $i++) {
            $user = new \App\Models\User();
            $user->name = "User" . $i;
            $user->email = "user" . $i . "@example.com";
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
