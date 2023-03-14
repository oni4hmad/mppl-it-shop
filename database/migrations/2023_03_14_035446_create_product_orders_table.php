<?php

use App\Enums\ProductOrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('courier_type_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('address_order_id')->constrained();
            $table->string('nama_penerima');
            $table->string('nomor_hp');
            $table->unsignedBigInteger('total_bayar');
            $table->integer('ongkos_kirim');
            $table->enum('status', ProductOrderStatus::getValues());
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
        Schema::dropIfExists('product_orders');
    }
}
