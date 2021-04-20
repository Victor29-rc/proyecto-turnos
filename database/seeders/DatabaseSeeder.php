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
            'phone' => '8099849880',
            'id_document' => '40213366285',
            'password' => bcrypt(123456789),
            'place' => 1
            
        ]);

        \App\Models\User::create([
            'name' => 'Victor Manuel Rosario Casado',
            'email' => 'manuel_victor_rc@hotmail.com',
            'phone' => '8099849880',
            'id_document' => '40213366284',
            'password' => bcrypt(123456789),
            'place' => 2
        ]);

       /*  Category::factory(5)->create();
        Shift::factory(10)->create(); */
    }
}
