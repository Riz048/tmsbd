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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->date('tanggal_pinjam');
            $table->integer('lama_pinjam');
            $table->text('keterangan')->nullable();

            $table->enum('status', ['dipinjam','sudah dikembalikan'])->default('dipinjam');

            // FK ke user
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');

            // FK ke petugas
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
