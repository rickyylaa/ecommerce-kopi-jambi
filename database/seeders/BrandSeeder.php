<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'title' => 'Kopi AAA',
            'slug' => 'kopi-aaa',
            'image' => 'kopi-aaa.jpeg',
            'description' => 'Kopi AAA',
            'status' => 1
        ]);

        Brand::create([
            'title' => 'Kopi Paman',
            'slug' => 'kopi-paman',
            'image' => 'kopi-paman.jpeg',
            'description' => 'Kopi Paman',
            'status' => 1
        ]);

        Brand::create([
            'title' => 'Kopi Jambi',
            'slug' => 'kopi-jambi',
            'image' => 'kopi-jambi.jpeg',
            'description' => 'Kopi Jambi',
            'status' => 1
        ]);

        Brand::create([
            'title' => 'Kopi Robusta',
            'slug' => 'kopi-robusta',
            'image' => 'kopi-robusta.png',
            'description' => 'Kopi Robusta',
            'status' => 1
        ]);

        Brand::create([
            'title' => 'Kopi Arabica',
            'slug' => 'kopi-arbica',
            'image' => 'kopi-arabica.png',
            'description' => 'Kopi Arabica',
            'status' => 1
        ]);

        Brand::create([
            'title' => 'Kopi Liberica',
            'slug' => 'kopi-liberica',
            'image' => 'kopi-liberica.jpg',
            'description' => 'Kopi liberica',
            'status' => 1
        ]);
    }
}
