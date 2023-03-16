<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStackOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stack_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_order_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('nama');
            $table->unsignedInteger('kuantitas');
            $table->unsignedBigInteger('harga');
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
        Schema::dropIfExists('product_stack_orders');
    }
}
