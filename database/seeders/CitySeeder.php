<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `cities` (`id`, `province_id`, `name`, `type`, `postal_code`, `created_at`, `updated_at`) VALUES
        (50, 8, 'Batang Hari', 'Kabupaten', '36613', '2019-08-29 12:55:53', '2019-08-29 12:55:53'),
        (97, 8, 'Bungo', 'Kabupaten', '37216', '2019-08-29 12:55:53', '2019-08-29 12:55:53'),
        (156, 8, 'Jambi', 'Kota', '36111', '2019-08-29 12:55:53', '2019-08-29 12:55:53'),
        (194, 8, 'Kerinci', 'Kabupaten', '37167', '2019-08-29 12:55:53', '2019-08-29 12:55:53'),
        (280, 8, 'Merangin', 'Kabupaten', '37319', '2019-08-29 12:55:53', '2019-08-29 12:55:53'),
        (293, 8, 'Muaro Jambi', 'Kabupaten', '36311', '2019-08-29 12:55:54', '2019-08-29 12:55:54'),
        (393, 8, 'Sarolangun', 'Kabupaten', '37419', '2019-08-29 12:55:54', '2019-08-29 12:55:54'),
        (442, 8, 'Sungaipenuh', 'Kota', '37113', '2019-08-29 12:55:54', '2019-08-29 12:55:54'),
        (460, 8, 'Tanjung Jabung Barat', 'Kabupaten', '36513', '2019-08-29 12:55:54', '2019-08-29 12:55:54'),
        (461, 8, 'Tanjung Jabung Timur', 'Kabupaten', '36719', '2019-08-29 12:55:54', '2019-08-29 12:55:54'),
        (471, 8, 'Tebo', 'Kabupaten', '37519', '2019-08-29 12:55:54', '2019-08-29 12:55:54');");
    }
}
