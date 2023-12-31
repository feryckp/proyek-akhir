<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->integer('jumlah_produk');
            $table->decimal('total_harga', 10, 2);
            $table->date('tanggal_transaksi');
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
