<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,100) as $index)
        {
            DB::table('products')->insert([
                'name' => $faker->word,
                'kategori' => 'Processor',
                'harga' => $faker->numberBetween($min = 200000, $max = 10000000),
                'stok' => $faker->numberBetween($min = 1, $max = 100),
                'berat' => $faker->numberBetween($min = 1, $max = 1000),
                'deskripsi' => $faker->text,
                'foto1' => 'vga.png',
                'foto2' => 'processor.jpg',
                'foto3' => 'ram.jpg',
                'foto4' => 'monitor.jpg',
            ]);
        }

    }
}
