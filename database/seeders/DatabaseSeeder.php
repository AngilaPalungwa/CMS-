<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Roles;
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
        $this->call(UserTableSeeder::class);
        User::factory(10)->create();
        // Roles::factory(10)->create();
        Category::factory(10)->create();
    }
}
