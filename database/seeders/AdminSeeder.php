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
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('staffpassword123'),
            'role' => 'staff',
        ]);
        
    }
}

