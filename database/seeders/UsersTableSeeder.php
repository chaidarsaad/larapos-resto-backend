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

        $user = new \App\Models\User();
        $user->name = 'chaidar';
        $user->email = 'chaidar@gmail.com';
        $user->password = bcrypt('aaaaaaaa');
        $user->role = 'admin';
        $user->save();
    }
}
