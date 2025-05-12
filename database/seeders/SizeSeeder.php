<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'title' => 'Kecil',
            'slug' => 'kecil',
            'description' => 'Ukuran Kecil',
            'status' => 1
        ]);

        Size::create([
            'title' => 'Sedang',
            'slug' => 'sedang',
            'description' => 'Ukuran Sedang',
            'status' => 1
        ]);

        Size::create([
            'title' => 'Besar',
            'slug' => 'besar',
            'description' => 'Ukuran Besar',
            'status' => 1
        ]);
    }
}
