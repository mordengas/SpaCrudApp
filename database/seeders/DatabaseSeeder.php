<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         Client::factory(10)->create();
         Treatment::factory(10)->create();

         User::factory()->create([
             'name' => 'Dominik Machnik',
             'email' => 'dominik120801@gmail.com',
             'password' => 'haslo123',
             'remember_token' => Str::random(10),
         ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testmail@gmail.com',
            'password' => 'test123',
            'remember_token' => Str::random(10),
        ]);
    }
}
