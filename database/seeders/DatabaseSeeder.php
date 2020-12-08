<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'email@example.com',
            'password' => Str::random(12),
            'api_token' => Str::random(60)
        ]);

        \App\Models\Invoice::factory(50)->create();
    }
}
