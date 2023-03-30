<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN
        ]);

        User::create([
            'name' => 'technical',
            'email' => 'ta@ta.com',
            'password' => Hash::make('password'),
            'role' => UserRole::TECHNICAL
        ]);


        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'role' => UserRole::USER
        ]);

        $this->call([
            LabelSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            TicketSeeder::class
        ]);
    }
}
