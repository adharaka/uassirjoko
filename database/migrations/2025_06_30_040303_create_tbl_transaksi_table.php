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
            $table->increments('id_transaksi'); // primary key auto increment 
            $table->string('no_transaksi', 50)->nullable(false); // nvarchar(50), required 
            $table->date('tgl_transaksi')->nullable(false); // date, required 
            $table->bigInteger('total_bayar')->nullable(false); // bigint, required 
            $table->integer('id_user')->nullable(false); // fk, int, required 
            $table->integer('id_barang')->nullable(false); // fk, int, required 

            // Menambahkan Foreign Keys
            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            $table->foreign('id_barang')->references('id_barang')->on('tbl_barang')->onDelete('restrict');
            // $table->timestamps();
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