<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'superadmin',
            'name' => 'superadmin',
            'password' => Hash::make('password123'),
            'role'     => 'superadmin',
            'created_at' => now(),
        ]);

        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
            'created_at' => now(),
        ]);

        User::create([
            'username' => 'marketing1',
            'name' => 'marketing',
            'password' => Hash::make('marketing123'),
            'role'     => 'marketing',
            'created_at' => now(),
        ]);


    }
}
