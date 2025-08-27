<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin; // Import SuperAdmin model
use Illuminate\Support\Facades\Hash; // Import Hash for password hashing

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'egkom@gmail.com',
            'password' => Hash::make('Hmj54646##'), // Use a secure password
            'role' => 'super-admin',
        ]);
    }
}
