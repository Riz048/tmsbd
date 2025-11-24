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
        Schema::create('petugas', function (Blueprint $table) {

            // PK + FK
            $table->unsignedBigInteger('id_pegawai')->primary();

            $table->enum('status', ['aktif', 'non-aktif']);

            // FK ke user.id_user
            $table->foreign('id_pegawai')
                ->references('id_user')->on('user')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
