<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Courier;
use App\Models\CourierType;
use App\Models\Product;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* init faker */
        $faker = Factory::create('id_ID');
        $generateNumber = fn () => substr(str_shuffle(str_repeat('0123456789', rand(8, 10))), 0, rand(8, 10));

        // \App\Models\User::factory(10)->create();

        /* User: Customer, Admin, Technician */
        /* create customer */
        DB::table('users')->insert([
            'nama' => 'Yuser',
            'email' => 'user@gmail.com',
            'nomor_hp' => '0893437473',
            'user_type' => UserType::CUSTOMER,
            'kota' => 'Surabaya',
            'kode_pos' => '60185',
            'alamat' => 'Jl. Manukan Kulon 88B',
            'password' => bcrypt('121212'),
        ]);

        /* create admin */
        DB::table('users')->insert([
            'nama' => 'Mimin',
            'email' => 'admin@gmail.com',
            'nomor_hp' => '0812138383',
            'user_type' => UserType::ADMINISTRATOR,
            'kota' => 'Surabaya',
            'kode_pos' => '60111',
            'alamat' => 'Jl. Kandangan 137GG',
            'password' => bcrypt('121212'),
        ]);

        /* create technician */
        DB::table('users')->insert([
            'nama' => 'Mas Teknisi',
            'email' => 'teknisi@gmail.com',
            'nomor_hp' => '08'.$generateNumber(),
            'user_type' => UserType::TECHNICIAN,
            'kota' => $faker->city,
            'kode_pos' => $faker->postcode,
            'alamat' => $faker->streetAddress,
            'password' => bcrypt('121212'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Budi Hartono',
            'email' => 'budi@gmail.com',
            'nomor_hp' => '08'.$generateNumber(),
            'user_type' => UserType::TECHNICIAN,
            'kota' => $faker->city,
            'kode_pos' => $faker->postcode,
            'alamat' => $faker->streetAddress,
            'password' => bcrypt('121212'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Eko Utomo',
            'email' => 'eko@gmail.com',
            'nomor_hp' => '08'.$generateNumber(),
            'user_type' => UserType::TECHNICIAN,
            'kota' => $faker->city,
            'kode_pos' => $faker->postcode,
            'alamat' => $faker->streetAddress,
            'password' => bcrypt('121212'),
        ]);
        DB::table('users')->insert([
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@gmail.com',
            'nomor_hp' => '08'.$generateNumber(),
            'user_type' => UserType::TECHNICIAN,
            'kota' => $faker->city,
            'kode_pos' => $faker->postcode,
            'alamat' => $faker->streetAddress,
            'password' => bcrypt('121212'),
        ]);

        User::all()->each(function ($user) {
            Cart::create(['user_id' => $user->id]);
            if ($user->user_type == UserType::TECHNICIAN) {
                Technician::create(['user_id' => $user->id]);
            }
        });

        /* Category */
        /* add initial category */
        DB::table('categories')->insert([
            ['nama' => 'Processor', 'slug' => 'processor'],
            ['nama' => 'Graphics Card', 'slug' => 'graphics-card'],
            ['nama' => 'Memory', 'slug' => 'memory'],
            ['nama' => 'Storage', 'slug' => 'storage'],
            ['nama' => 'Monitor', 'slug' => 'monitor'],
        ]);
        DB::table('photos')->insert([
            ['path' => 'photo/category/proci.png', 'photoable_id' => 1, 'photoable_type' => Category::class ],
            ['path' => 'photo/category/gpu.png', 'photoable_id' => 2, 'photoable_type' => Category::class ],
            ['path' => 'photo/category/ram.png', 'photoable_id' => 3, 'photoable_type' => Category::class ],
            ['path' => 'photo/category/storage.png', 'photoable_id' => 4, 'photoable_type' => Category::class ],
            ['path' => 'photo/category/monitor.png', 'photoable_id' => 5, 'photoable_type' => Category::class ],
        ]);

        Category::all()->each(function ($category) {
            $products = Product::factory()->count(10)->make();
            $category->products()->saveMany($products);
        });

        /* Payment Method */
        DB::table('payment_methods')->insert([
            ['nama' => 'BCA (Nomor Rekening)', 'nomor_rekening' => '0005‑01‑00130‑7304'],
            ['nama' => 'BNI (Nomor Rekening)', 'nomor_rekening' => '123‑12‑4001'],
            ['nama' => 'Mandiri (Nomor Rekening)', 'nomor_rekening' => '27‑9300‑3056'],
        ]);

        /* Courier */
        DB::table('couriers')->insert([
            ['nama' => 'JNE'],
            ['nama' => 'J&T'],
            ['nama' => 'SiCepat'],
            ['nama' => 'POS Indonesia'],
        ]);
        /* Courier Type */
        Courier::all()->each(function ($courier) {
            CourierType::insert([
                ["courier_id" => $courier->id, "nama" => "Regular", "harga" => 10000],
                ["courier_id" => $courier->id, "nama" => "Express", "harga" => 17000],
                ["courier_id" => $courier->id, "nama" => "Instant", "harga" => 28000],
            ]);
        });
    }
}
