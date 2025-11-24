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
        Schema::create('buku', function (Blueprint $table) {
            $table->id(); // id (PK)

            $table->enum('kelas_akademik', ['10', '11', '12', 'non-akademik'])->nullable();
            $table->enum('tipe_bacaan', ['fiksi', 'non-fiksi'])->nullable();

            $table->string('kode_buku', 30);
            $table->string('judul', 50);
            $table->string('nama_penerbit', 100);
            $table->string('isbn', 17);
            $table->string('pengarang', 150);

            $table->integer('jlh_hal');
            $table->integer('jlh_buku');

            $table->enum('status_buku', ['baik', 'rusak', 'hilang'])->default('baik');

            $table->integer('tahun_terbit');

            $table->text('sinopsis')->nullable();
            $table->string('gambar', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
