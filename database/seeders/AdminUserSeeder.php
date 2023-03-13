<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@example.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('admin'),
            'is_admin'=>1
        ]);

        User::factory()->create([
            'name'=>'user',
            'email'=>'user@user.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('user'),
        ]);
    }
}
