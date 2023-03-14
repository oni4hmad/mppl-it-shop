<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => strtoupper($this->faker->words(mt_rand(5, 10), true)),
            'harga' => $this->faker->numberBetween(500000, 5000000),
            'stok' => $this->faker->numberBetween(1, 200),
            'berat' => $this->faker->numberBetween(200, 2000),
            'deskripsi' => $this->faker->paragraphs(2, true),
            'photo_id_1' => null,
            'photo_id_2' => null,
            'photo_id_3' => null,
            'photo_id_4' => null,
        ];
    }
}
