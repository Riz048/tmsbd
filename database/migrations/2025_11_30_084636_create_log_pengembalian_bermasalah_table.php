<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_pengembalian_bermasalah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengembalian_id');
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('user_id');
            $table->string('kondisi', 50);
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));

            // optional FK
            $table->foreign('pengembalian_id')->references('id')->on('pengembalian')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pengembalian_bermasalah');
    }
};
