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
            $table->increments('id_user'); // primary key auto increment 
            $table->string('tipe_user', 50)->nullable(false); // nvarchar(50), required 
            $table->string('nama', 50)->nullable(false); // nvarchar(50), required 
            $table->string('alamat', 150)->nullable(false); // nvarchar(150), required 
            $table->string('telpon', 50)->nullable(false); // nvarchar(50), required 
            $table->string('username', 50)->nullable(false); // nvarchar(50), required 
            $table->string('password', 50)->nullable(true); // nvarchar(50), not required 
            // Laravel secara default tidak menambahkan created_at dan updated_at untuk tabel ini jika tidak dibutuhkan secara eksplisit.
            // Jika Anda ingin menambahkannya, uncomment baris di bawah:
            // $table->timestamps();
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