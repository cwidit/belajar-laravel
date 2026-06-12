<?php

namespace Database\Seeders;

//use Hash;
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
        //insert into
        User::create([
            'name' => 'Widitiya',
            'email' => 'widitya48@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1
        ]);
    }
}
