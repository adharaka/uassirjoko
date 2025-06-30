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
        Schema::create('tbl_log', function (Blueprint $table) {
            $table->increments('id_log'); // primary key auto increment 
            $table->timestamp('waktu')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP')); // timestamp, required 
            $table->string('aktivitas', 50)->nullable(false); // nvarchar(50), required 
            $table->integer('id_user')->nullable(false); // fk, int, required 

            // Menambahkan Foreign Key
            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('restrict');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_log');
    }
};