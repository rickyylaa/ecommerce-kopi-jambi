<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Kopi Jambi Bentuk Saset Ukuran 45gr',
            'slug' => 'kopi-jambi-bentuk-saset-ukuran-45gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 1,
            'price' => '6000',
            'weight' => '45',
            'qty' => '500',
            'image' => 'kopi-jambi-45gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Jambi Bentuk Saset Ukuran 100gr',
            'slug' => 'kopi-jambi-bentuk-saset-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 1,
            'price' => '12000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-jambi-100gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 1,
        ]);

        Product::create([
            'title' => 'Kopi Jambi Bentuk Saset Ukuran 250gr',
            'slug' => 'kopi-jambi-bentuk-saset-ukuran-250gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 2,
            'price' => '18000',
            'weight' => '250',
            'qty' => '500',
            'image' => 'kopi-jambi-250gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Jambi Bentuk Kaleng Ukuran 300gr',
            'slug' => 'kopi-jambi-bentuk-kaleng-ukuran-300gr',
            'category_id' => 2,
            'brand_id' => 3,
            'size_id' => 2,
            'price' => '30000',
            'weight' => '300',
            'qty' => '500',
            'image' => 'kopi-jambi-300gr.jpg',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Jambi Bentuk Saset Ukuran 500gr',
            'slug' => 'kopi-jambi-bentuk-saset-ukuran-500gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 3,
            'price' => '45000',
            'weight' => '500',
            'qty' => '500',
            'image' => 'kopi-jambi-500gr.jpg',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Paket Kopi Jambi',
            'slug' => 'paket-kopi-jambi',
            'category_id' => 3,
            'brand_id' => 3,
            'size_id' => 3,
            'price' => '120000',
            'weight' => '1500',
            'qty' => '500',
            'image' => 'paket-kopi-jambi.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV Kopi Murni jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Paman Bentuk Saset Ukuran 100gr',
            'slug' => 'kopi-paman-bentuk-saset-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 2,
            'size_id' => 1,
            'price' => '10000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-paman-100gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'status' => 1,
        ]);

        Product::create([
            'title' => 'Kopi Paman Bentuk Saset Ukuran 250gr',
            'slug' => 'kopi-paman-bentuk-saset-ukuran-250gr',
            'category_id' => 1,
            'brand_id' => 2,
            'size_id' => 2,
            'price' => '22000',
            'weight' => '250',
            'qty' => '500',
            'image' => 'kopi-paman-250gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Paman Bentuk Kaleng Ukuran 300gr',
            'slug' => 'kopi-paman-bentuk-kaleng-ukuran-300gr',
            'category_id' => 1,
            'brand_id' => 2,
            'size_id' => 3,
            'price' => '10000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-paman-300gr.jpg',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh PD SUBUR JAYA',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Saset Ukuran 45gr',
            'slug' => 'kopi-aaa-bentuk-saset-ukuran-45gr',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 1,
            'price' => '9000',
            'weight' => '45',
            'qty' => '500',
            'image' => 'kopi-aaa-45gr.jpg',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Kotak Ukuran 100gr',
            'slug' => 'kopi-aaa-bentuk-kotak-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 1,
            'price' => '16000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-aaa-100gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 1,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Kaleng Ukuran 200gr',
            'slug' => 'kopi-aaa-bentuk-kaleng-ukuran-200gr',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 2,
            'price' => '50000',
            'weight' => '200',
            'qty' => '500',
            'image' => 'kopi-aaa-200gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Kotak Ukuran 250gr',
            'slug' => 'kopi-aaa-bentuk-kotak-ukuran-250gr',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 2,
            'price' => '45000',
            'weight' => '250',
            'qty' => '500',
            'image' => 'kopi-aaa-250gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Kotak Ukuran 500gr',
            'slug' => 'kopi-aaa-bentuk-kotak-ukuran-500gr',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 3,
            'price' => '80000',
            'weight' => '500',
            'qty' => '500',
            'image' => 'kopi-aaa-500gr.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi AAA Bentuk Kotak Ukuran 1kg',
            'slug' => 'kopi-aaa-bentuk-kotak-ukuran-1kg',
            'category_id' => 1,
            'brand_id' => 1,
            'size_id' => 3,
            'price' => '155000',
            'weight' => '1000',
            'qty' => '500',
            'image' => 'kopi-aaa-1kg.png',
            'summary' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'description' => 'Kopi bubuk khas Jambi yang diproduksi oleh CV PERUSAHAAN KOPI BUBUK NEFO',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Beraso Coffee Ukuran 100gr',
            'slug' => 'beraso-coffee-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 5,
            'size_id' => 1,
            'price' => '25000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-arabica-kerinci-(beraso coffee)-100gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Beraso Coffee Premium Ukuran 100gr',
            'slug' => 'beraso-coffee-premium-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 5,
            'size_id' => 1,
            'price' => '45000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-arabica-(premium coffe)-100gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Beraso Coffee Ukuran 150gr',
            'slug' => 'beraso-coffee-ukuran-150gr',
            'category_id' => 1,
            'brand_id' => 5,
            'size_id' => 2,
            'price' => '35000',
            'weight' => '150',
            'qty' => '500',
            'image' => 'kopi-arabica-(beraso coffe)-150gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Batuah Kerinci Ukuran 100gr',
            'slug' => 'kopi-batuah-kerinci-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 1,
            'price' => '35000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-batuah-kerinci-100gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Batuah Kerinci',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh Batuah Kerinci',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Aren dan Rempah Mentenang Jangkat Ukuran 55gr',
            'slug' => 'beraso-coffee-ukuran-150gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 1,
            'price' => '25000',
            'weight' => '55',
            'qty' => '500',
            'image' => 'kopi-aren-dan-rempah-mentenang-jangkat-55gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberica Lembah Mentenang Jangkat Ukuran 55gr',
            'slug' => 'kopi-liberica-lembah-mentenang-jangkat-ukuran-55gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 1,
            'price' => '25000',
            'weight' => '55',
            'qty' => '500',
            'image' => 'kopi-liberica-lembah-mentenang-jangkat-55gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberica Lembah Mentenang Jangkat Ukuran 90gr',
            'slug' => 'kopi-liberica-lembah-mentenang-jangkat-ukuran-90gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 2,
            'price' => '35000',
            'weight' => '90',
            'qty' => '500',
            'image' => 'kopi-liberica-lembah-mentenang-jangkat-90gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberica Lembah Mentenang Jangkat Ukuran 500gr',
            'slug' => 'kopi-liberica-lembah-mentenang-jangkat-500gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 3,
            'price' => '90000',
            'weight' => '500',
            'qty' => '500',
            'image' => 'kopi-liberica-lembah-mentenang-jangkat-500gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh PT Lembah Mentenang Jangkat',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberica (Beraso Coffee) Tungkal Ukuran 100gr',
            'slug' => 'kopi-liberica-(beraso coffee)-tungkal-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 1,
            'price' => '35000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-liberica-(beraso coffee)-tungkal-100gr.png',
            'summary' => 'Kopi bubuk khas Tungkal yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberica Premium Tungkal Ukuran 100gr',
            'slug' => 'kopi-liberica-premium-tungkal-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 1,
            'price' => '45000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-liberica-premium-tungkal-100gr.png',
            'summary' => 'Kopi bubuk khas Tungkal yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Tungkal yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Liberika Tungkal Ukuran 100gr',
            'slug' => 'kopi-liberika-tungkal-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 6,
            'size_id' => 1,
            'price' => '35000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-liberika-tungkal-100gr.png',
            'summary' => 'Kopi bubuk khas Tungkal yang diproduksi oleh MPIG Kopi Liberika Tungkal Jambi',
            'description' => 'Kopi bubuk khas Tungkal yang diproduksi oleh MPIG Kopi Liberika Tungkal Jambi',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi G Royal Kerinci Bentuk Kotak Ukuran 100gr',
            'slug' => 'kopi-G Royal-kerinci-bentuk-kotak-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 3,
            'size_id' => 1,
            'price' => '23000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-g royal-kerinci-100gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh ICN Kerinci',
            'description' => 'Kopi bubuk khas Tungkal yang diproduksi oleh ICN Kerinci',
            'status' => 1,
        ]);

        Product::create([
            'title' => 'Kopi Robusta Djangkat Merangin Ukuran 40gr',
            'slug' => 'kopi-robusta-djangkat-merangin-ukuran-40gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 1,
            'price' => '30000',
            'weight' => '40',
            'qty' => '500',
            'image' => 'kopi-robusta-djangkat-merangin-40gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Kopi Merangin Djangkat',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Kopi Merangin Djangkat',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Robusta jangkat (Beraso Coffee) Ukuran 100gr',
            'slug' => 'kopi-robusta-dangkat-(beraso coffee)-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 1,
            'price' => '25000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-robusta-jangkat-(beraso coffee)-100gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Beraso Coffee',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Beraso Coffee',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Robusta G Royal Kerinci Ukuran 100gr',
            'slug' => 'kopi-robusta-g royal-kerinci-ukuran-100gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 1,
            'price' => '30000',
            'weight' => '100',
            'qty' => '500',
            'image' => 'kopi-robusta-g royal-kerinci-100gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh ICN Kerinci',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh ICN Kerinci',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi G Royal Robusta Kerinci Ukuran 150gr',
            'slug' => 'kopi-g royal-robusta-kerinci-ukuran-150gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 2,
            'price' => '25000',
            'weight' => '150',
            'qty' => '500',
            'image' => 'kopi-g royal-robusta-kerinci-150gr.png',
            'summary' => 'Kopi bubuk khas Kerinci yang diproduksi oleh ICN Kerinci',
            'description' => 'Kopi bubuk khas Kerinci yang diproduksi oleh ICN Kerinci',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Robusta Mentenang Jangkat Ukuran 90gr',
            'slug' => 'kopi-robusta-mentenang-jangkat-ukuran-90gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 1,
            'price' => '20000',
            'weight' => '90',
            'qty' => '500',
            'image' => 'kopi-robusta-mentenang-jangkat-90gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Robusta Mentenang Jangkat Ukuran 180gr',
            'slug' => 'kopi-robusta-mentenang-jangkat-ukuran-180gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 2,
            'price' => '35000',
            'weight' => '180',
            'qty' => '500',
            'image' => 'kopi-robusta-mentenang-jangkat-180gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'status' => 0,
        ]);

        Product::create([
            'title' => 'Kopi Robusta Mentenang Jangkat Ukuran 500gr',
            'slug' => 'kopi-robusta-mentenang-jangkat-ukuran-500gr',
            'category_id' => 1,
            'brand_id' => 4,
            'size_id' => 3,
            'price' => '90000',
            'weight' => '500',
            'qty' => '500',
            'image' => 'kopi-robusta-mentenang-jangkat-500gr.png',
            'summary' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'description' => 'Kopi bubuk khas Jangkat yang diproduksi oleh Perusahaan LM Jangkat, KWT - Cahaya Madras',
            'status' => 0,
        ]);


    }
}
