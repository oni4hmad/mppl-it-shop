<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama');
            $table->foreignId('category_id')->constrained();

//            $table->unsignedBigInteger('category_id');
//            $table->foreign('category_id')->references('id')->on('categories');

            $table->bigInteger('harga');
            $table->integer('stok');
            $table->integer('berat');
            $table->text('deskripsi');
            $table->integer('terjual')->default(0);
            $table->unsignedFloat('rating')->default(0.0);
            $table->integer('jumlah_ulasan')->default(0);

            $table->unsignedBigInteger('photo_id_1')->nullable();
            $table->foreign('photo_id_1')->references('id')->on('photos');

            $table->unsignedBigInteger('photo_id_2')->nullable();
            $table->foreign('photo_id_2')->references('id')->on('photos');

            $table->unsignedBigInteger('photo_id_3')->nullable();
            $table->foreign('photo_id_3')->references('id')->on('photos');

            $table->unsignedBigInteger('photo_id_4')->nullable();
            $table->foreign('photo_id_4')->references('id')->on('photos');

//            $table->foreignId('photo_1')->nullable();
//            $table->foreignId('photo_2')->nullable();
//            $table->foreignId('photo_3')->nullable();
//            $table->foreignId('photo_4')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
