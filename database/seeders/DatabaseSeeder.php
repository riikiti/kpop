<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enum\GroupEnum;
use App\Models\Admin;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Admin::factory(1)->create();
        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Bts,
        ]);
        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::StrayKids,
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Enhypen,
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::TXT,
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Blackpink,
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Ateez
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Itzy,
        ]);

        Group::query()->firstOrCreate([

            'name' =>  GroupEnum::Twice,
        ]);
    }
}
