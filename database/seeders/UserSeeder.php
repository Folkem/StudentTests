<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@studenttests.com',
            'password' => Hash::make('password'),
            'role_id' => Role::query()->where('name', 'admin')->first('id'),
        ]);
        User::factory()
            ->count(10)
            ->create();
    }
}
