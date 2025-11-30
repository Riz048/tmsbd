<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arsip_buku', function (Blueprint $table) {
            $table->id();
            $table->string('kelas_akademik')->nullable();
            $table->string('tipe_bacaan')->nullable();
            $table->string('kode_buku')->nullable();
            $table->string('judul');
            $table->string('nama_penerbit')->nullable();
            $table->string('isbn')->nullable();
            $table->string('pengarang')->nullable();
            $table->integer('jlh_hal')->nullable();
            $table->integer('jlh_buku')->nullable();
            $table->enum('status_buku', ['baik','rusak','hilang'])->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_buku');
    }
};
