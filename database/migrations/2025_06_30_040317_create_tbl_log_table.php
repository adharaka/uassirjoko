
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_log', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu');
            $table->string('aktivitas', 255);
            $table->unsignedInteger('id_user')->nullable();
            // Jika id_user adalah foreign key ke tbl_user:
            $table->foreign('id_user')->references('id_user')->on('tbl_user')->onDelete('cascade');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_log');
    }
};