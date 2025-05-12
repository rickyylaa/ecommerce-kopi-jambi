<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['admin']);

        User::create([
            'username' => 'kopi-jambi',
            'name' => 'Kopi Jambi',
            'email' => 'kopi-jambi@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-aaa',
            'name' => 'Kopi AAA',
            'email' => 'kopi-aaa@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-paman',
            'name' => 'Kopi Paman',
            'email' => 'kopi-paman@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'beraso-coffee',
            'name' => 'Beraso Coffee',
            'email' => 'beraso-coffee@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-lembah-mentenang-jangkat',
            'name' => 'Kopi Lembah Mentenang Jangkat',
            'email' => 'kopi-lembah-mentenang-jangkat@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-g-royal-kerinci',
            'name' => 'Kopi G`Royal Kerinci',
            'email' => 'kopi-g-royal-kerinci@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-merangin-djangkat',
            'name' => 'Kopi Merangin Djangkat',
            'email' => 'kopi-merangin-djangkat@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);

        User::create([
            'username' => 'kopi-tungkal-liberica',
            'name' => 'Kopi Tungkal Liberica',
            'email' => 'kopi-tungkal-liberica@gmail.com',
            'password' => bcrypt('1'),
            'email_verified_at' => now(),
            'phone' => '08123456789',
            'image' => 'avatar.png',
        ])->assignRole(['owner']);
    }
}
