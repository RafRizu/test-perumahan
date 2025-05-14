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
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
            'created_at' => now(),
        ]);

        User::create([
            'username' => 'marketing1',
            'password' => Hash::make('marketing123'),
            'role'     => 'marketing',
            'created_at' => now(),
        ]);

        User::create([
            'username' => 'viewer1',
            'password' => Hash::make('viewer123'),
            'role'     => 'viewer',
            'created_at' => now(),
        ]);
    }
}
