<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifikasi_terlambat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_peminjaman');
            $table->integer('hari_terlambat');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->cascadeOnDelete();
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasi_terlambat');
    }
};
