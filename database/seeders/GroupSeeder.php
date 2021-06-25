<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [
            'КН', 'БС',
        ];

        $groups = [];

        foreach ($specialities as $speciality) {
            $groups[] = "$speciality-41";
            $groups[] = "{$speciality}з-31";
        }

        foreach ($groups as $groupName) {
            Group::query()->create(['title' => $groupName]);
        }
    }
}
