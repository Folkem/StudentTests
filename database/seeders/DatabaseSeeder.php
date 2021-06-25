<?php

namespace Database\Seeders;

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
        $this->call([
            RoleSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            DisciplineSeeder::class,
            ControlTypeSeeder::class,
            TestSeeder::class,
            TestingSeeder::class,
        ]);
    }
}
