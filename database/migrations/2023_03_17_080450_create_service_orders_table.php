<?php

use App\Enums\ServiceOrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('technician_id')->nullable()->constrained();
            $table->foreignId('address_order_id')->constrained();
            $table->string('nama');
            $table->string('nomor_hp');
            $table->dateTime('waktu');
            $table->text('deskripsi_masalah');
            $table->text('rincian_servis')->nullable();
            $table->integer('biaya')->nullable();
            $table->enum('status', ServiceOrderStatus::getValues())
                ->default(ServiceOrderStatus::MENCARI_TEKNISI);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_orders');
    }
}
