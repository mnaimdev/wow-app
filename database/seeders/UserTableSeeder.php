<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make(1234),
            'created_at'    => Carbon::now(),
        ]);
    }
}
