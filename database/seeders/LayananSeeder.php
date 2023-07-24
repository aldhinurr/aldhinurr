<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Faker\Generator;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            Layanan::create([
                "type" => "RUANG",
                "name" => $faker->streetName(),
                "description" => $faker->paragraph(5),
                "address" => $faker->address(),
                "location" => "JATINANGOR",
                "price" => $faker->randomFloat(),
                "price_for" => "HARI",
                "status" => "AKTIF",
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            Layanan::create([
                "type" => "KENDARAAN",
                "name" => $faker->words(3, true),
                "description" => $faker->paragraph(5),
                "address" => $faker->address(),
                "location" => "GANESHA",
                "price" => $faker->randomFloat(),
                "price_for" => "HARI",
                "status" => "AKTIF",
            ]);
        }
    }
}
