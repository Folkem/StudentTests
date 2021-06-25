<?php

namespace Database\Seeders;

use App\Models\Group;
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
            'password' => Hash::make('password'),
            'role_id' => Role::query()->where('name', 'admin')->first('id'),
            'group_id' => null,
        ]);
        User::factory()->create([
            'name' => 'teacher',
            'password' => Hash::make('password'),
            'role_id' => Role::query()->where('name', 'teacher')->first('id'),
            'group_id' => null,
        ]);
        User::factory()->create([
            'name' => 'student',
            'password' => Hash::make('password'),
            'role_id' => Role::query()->where('name', 'student')->first('id'),
            'group_id' => Group::all()->random()->id,
        ]);
        User::factory()
            ->count(60)
            ->create();
    }
}
