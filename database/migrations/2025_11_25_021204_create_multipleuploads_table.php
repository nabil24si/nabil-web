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
        Schema::create('multiuploads', function (Blueprint $table) {
            $table->id(); // Menciptakan kolom 'id' INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('filename', 250); // Menciptakan kolom 'filename' VARCHAR(250) NOT NULL

            // Menciptakan kolom 'created_at' dan 'updated_at' dengan tipe DATETIME
            // dan menangani DEFAULT CURRENT_TIMESTAMP dan ON UPDATE CURRENT_TIMESTAMP secara otomatis.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiuploads');
    }
};
