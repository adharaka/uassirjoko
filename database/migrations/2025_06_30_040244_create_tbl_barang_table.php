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
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->increments('id_barang'); 
            $table->string('kode_barang', 50)->nullable(false); 
            $table->string('nama_barang', 50)->nullable(false);  
            $table->date('expired_date')->nullable(false); 
            $table->bigInteger('jumlah_barang')->nullable(false);
            $table->string('satuan', 50)->nullable(false);
            $table->bigInteger('harga_satuan')->nullable(false); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barang');
    }
};