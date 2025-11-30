<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arsip_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pinjam')->nullable();
            $table->integer('lama_pinjam')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_pegawai')->nullable();

            $table->foreign('id_user')->references('id_user')->on('user')->nullOnDelete();
            $table->foreign('id_pegawai')->references('id_pegawai')->on('petugas')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_peminjaman');
    }
};
