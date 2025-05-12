<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([BannerSeeder::class]);

        $this->call([CategorySeeder::class]);
        $this->call([BrandSeeder::class]);
        $this->call([SizeSeeder::class]);
        $this->call([ProductSeeder::class]);

        $this->call([ProvinceSeeder::class]);
        $this->call([CitySeeder::class]);
        $this->call([DistrictSeeder::class]);
    }
}
