<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            "name" => "karam",
            "email" => "karam@hotmail.com",
            "password" => bcrypt("123123123")
        ]);
        User::create([
            "name" => "elie",
            "email" => "elie@hotmail.com",
            "password" => bcrypt("123123123")
        ]);
    }
}
