<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'Saset',
            'slug' => 'saset',
            'parent_id' => NULL,
            'description' => 'Saset',
            'status' => 1
        ]);

        Category::create([
            'title' => 'Kaleng',
            'slug' => 'kaleng',
            'parent_id' => NULL,
            'description' => 'Kaleng',
            'status' => 1
        ]);

        Category::create([
            'title' => 'Paket',
            'slug' => 'paket',
            'parent_id' => NULL,
            'description' => 'Paket',
            'status' => 1
        ]);
    }
}
