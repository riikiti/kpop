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
            'status'=> 'Мужская группа'
        ]);
        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::StrayKids,
            'status'=> 'Мужская группа'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Enhypen,
            'status'=> 'Мужская группа'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::TXT,
            'status'=> 'Мужская группа'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Blackpink,
            'status'=> 'Женская группа'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Ateez,
            'status'=> 'Соло исполнитель'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Itzy,
            'status'=> 'Женская группа'
        ]);

        Group::query()->firstOrCreate([
            'name' =>  GroupEnum::Twice,
            'status'=> 'Женская группа'
        ]);
    }
}
