<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Database\Seeder;
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
            'nomor_hp' => '081213838',
            'user_type' => UserType::ADMINISTRATOR,
            'kota' => 'Surabaya',
            'kode_pos' => '60111',
            'alamat' => 'Jl. Kandangan 137GG',
            'password' => bcrypt('121212'),
        ]);

        /* create technician */
        DB::table('users')->insert([
            'nama' => 'Tweknisi',
            'email' => 'teknisi@gmail.com',
            'nomor_hp' => '082232873',
            'user_type' => UserType::TECHNICIAN,
            'kota' => 'Surabaya',
            'kode_pos' => '60113',
            'alamat' => 'Jl. Candi Lempung 420GG',
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
            ['nama' => 'Processor', 'slug' => 'processor', 'photo' => 'proci.png'],
            ['nama' => 'Graphics Card', 'slug' => 'graphics-card', 'photo' => 'gpu.png'],
            ['nama' => 'Memory', 'slug' => 'memory', 'photo' => 'ram.png'],
            ['nama' => 'Storage', 'slug' => 'storage', 'photo' => 'storage.png'],
            ['nama' => 'Monitor', 'slug' => 'monitor', 'photo' => 'monitor.png'],
        ]);
        Category::all()->each(function ($category) {
            $products = Product::factory()->count(10)->make();
            $category->products()->saveMany($products);
        });
    }
}
