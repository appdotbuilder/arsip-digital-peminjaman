<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@archive.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Kantor Arsip Digital',
        ]);

        // Create officer user
        User::create([
            'name' => 'Petugas Arsip',
            'email' => 'officer@archive.com',
            'password' => Hash::make('password'),
            'role' => 'officer',
            'phone' => '08123456788',
            'address' => 'Kantor Arsip Digital',
        ]);

        // Create employee users
        User::create([
            'name' => 'Pegawai Satu',
            'email' => 'employee1@archive.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'phone' => '08123456787',
            'address' => 'Rumah Pegawai 1',
        ]);

        User::create([
            'name' => 'Pegawai Dua',
            'email' => 'employee2@archive.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'phone' => '08123456786',
            'address' => 'Rumah Pegawai 2',
        ]);
    }
}