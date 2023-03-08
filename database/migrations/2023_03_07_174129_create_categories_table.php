<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        /* add initial category */
        DB::table('categories')->insert([
            ['nama' => 'Processor', 'photo' => 'proci.png'],
            ['nama' => 'Graphics Card', 'photo' => 'gpu.png'],
            ['nama' => 'Memory', 'photo' => 'ram.png'],
            ['nama' => 'Storage', 'photo' => 'storage.png'],
            ['nama' => 'Monitor', 'photo' => 'monitor.png'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
