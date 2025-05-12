<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::Create([
            'title' => 'Kopi Jambi',
            'slug' => 'kopi-jambi',
            'image' => 'kopi-jambi.jpg',
            'summary' => 'Percakapan dan rasa yang luar biasa',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'status' => 1
        ]);
    }
}
