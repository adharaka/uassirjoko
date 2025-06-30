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
            $table->increments('id_barang'); // primary key auto increment 
            $table->string('kode_barang', 50)->nullable(false); // nvarchar(50), required 
            $table->string('nama_barang', 50)->nullable(false); // nvarchar(50), required 
            $table->date('expired_date')->nullable(false); // date, required 
            $table->bigInteger('jumlah_barang')->nullable(false); // bigint, required 
            $table->string('satuan', 50)->nullable(false); // nvarchar(50), required 
            $table->bigInteger('harga_satuan')->nullable(false); // bigint, required 
            // $table->timestamps();
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