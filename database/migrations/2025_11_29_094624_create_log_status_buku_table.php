<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_status_buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status_lama', ['baik','rusak','hilang'])->nullable();
            $table->enum('status_baru', ['baik','rusak','hilang']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('buku_id')->references('id')->on('buku')->cascadeOnDelete();
            $table->foreign('user_id')->references('id_user')->on('user')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_status_buku');
    }
};
