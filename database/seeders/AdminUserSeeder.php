<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Main Admin',
                'password' => bcrypt('admin@gmail.com'),
                'role' => 'admin',
            ]
        );
    }

}
