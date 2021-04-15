<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shift;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Victor Manuel Rosario Casado',
            'email' => 'vrosario670@gmail.com',
            'password' => bcrypt(123456789)
        ]);

        \App\Models\User::create([
            'name' => 'Victor Manuel Rosario Casado',
            'email' => 'manuel_victor_rc@hotmail.com',
            'password' => bcrypt(123456789),
            'place' => 2
        ]);

        Category::factory(5)->create();
        Shift::factory(10)->create();
    }
}
