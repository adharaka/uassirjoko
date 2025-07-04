<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->string('no_transaksi', 50)->nullable(false);
            $table->date('tgl_transaksi')->nullable(false);
            $table->bigInteger('total_bayar')->nullable(false);
            $table->integer('id_user')->nullable(false);
            $table->integer('id_barang')->nullable(false); 

            // Menambahkan Foreign Keys
            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('tbl_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaksi');
    }
};