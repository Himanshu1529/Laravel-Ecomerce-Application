<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Himanshu Sharma',
            'email' => 'bhudevsharma002200@outlook.com',
            'password' => Hash::make('123456'), // Hashing the password
        ]);
    }
}
