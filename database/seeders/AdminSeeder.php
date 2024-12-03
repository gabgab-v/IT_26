<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create a Warehouse Admin
        Admin::create([
            'name' => 'Warehouse Admin',
            'email' => 'warehouse@example.com',
            'password' => Hash::make('password123'), // Hash the password for security
            'role' => 'warehouse',  // Assign the warehouse role
        ]);
    }
}

