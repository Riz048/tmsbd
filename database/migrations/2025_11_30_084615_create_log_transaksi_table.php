<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tabel');
            $table->string('aksi');
            $table->unsignedBigInteger('id_row');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_transaksi');
    }
};
