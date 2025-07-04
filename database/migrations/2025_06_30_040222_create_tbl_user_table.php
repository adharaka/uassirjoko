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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('tipe_user', 50)->nullable(false); 
            $table->string('nama', 50)->nullable(false);
            $table->string('alamat', 150)->nullable(false);
            $table->string('telpon', 50)->nullable(false);
            $table->string('username', 50)->nullable(false);
            $table->string('password', 50)->nullable(true); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};