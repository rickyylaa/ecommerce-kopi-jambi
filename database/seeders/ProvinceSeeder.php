<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
        (8, 'Jambi', '2019-08-29 12:55:52', '2019-08-29 12:55:52');");
    }
}
