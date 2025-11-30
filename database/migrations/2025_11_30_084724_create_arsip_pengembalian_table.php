<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arsip_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('foto_bukti')->nullable();

            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->nullOnDelete();
            $table->foreign('id_user')->references('id_user')->on('user')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_pengembalian');
    }
};
