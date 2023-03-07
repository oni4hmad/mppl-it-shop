<?php

use App\Enums\UserType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->integer('user_type')->default(UserType::CUSTOMER);
            $table->string('nomor_hp');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('alamat');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
