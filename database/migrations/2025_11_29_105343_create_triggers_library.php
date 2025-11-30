<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER trg_update_stok_pinjam
            AFTER INSERT ON peminjaman_detail
            FOR EACH ROW
            BEGIN
                UPDATE buku
                SET jlh_buku = jlh_buku - NEW.jumlah
                WHERE id = NEW.buku_id;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_update_stok_kembali
            AFTER INSERT ON pengembalian
            FOR EACH ROW
            BEGIN
                UPDATE buku b
                JOIN peminjaman_detail d ON d.buku_id = b.id
                SET b.jlh_buku = b.jlh_buku + d.jumlah
                WHERE d.peminjaman_id = NEW.peminjaman_id;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_status_peminjaman
            AFTER INSERT ON pengembalian
            FOR EACH ROW
            BEGIN
                UPDATE peminjaman
                SET status = 'sudah dikembalikan'
                WHERE id = NEW.peminjaman_id;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_log_transaksi_insert
            AFTER INSERT ON peminjaman
            FOR EACH ROW
            BEGIN
                INSERT INTO log_transaksi (nama_tabel, aksi, id_row, id_user, keterangan)
                VALUES ('peminjaman', 'INSERT', NEW.id, NEW.id_user, 'Insert peminjaman');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_log_transaksi_update
            AFTER UPDATE ON peminjaman
            FOR EACH ROW
            BEGIN
                INSERT INTO log_transaksi (nama_tabel, aksi, id_row, id_user, keterangan)
                VALUES ('peminjaman', 'UPDATE', NEW.id, NEW.id_user, 'Update peminjaman');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_log_transaksi_delete
            AFTER DELETE ON peminjaman
            FOR EACH ROW
            BEGIN
                INSERT INTO log_transaksi (nama_tabel, aksi, id_row, id_user, keterangan)
                VALUES ('peminjaman', 'DELETE', OLD.id, OLD.id_user, 'Delete peminjaman');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER trg_cek_stok
            BEFORE INSERT ON peminjaman_detail
            FOR EACH ROW
            BEGIN
                DECLARE v_stok INT;

                SELECT jlh_buku INTO v_stok
                FROM buku
                WHERE id = NEW.buku_id
                FOR UPDATE;

                IF v_stok IS NULL THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Buku tidak ditemukan';
                ELSEIF NEW.jumlah > v_stok THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok buku tidak mencukupi';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_update_stok_pinjam");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_update_stok_kembali");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_status_peminjaman");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_log_transaksi_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_log_transaksi_update");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_log_transaksi_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_cek_stok");
    }
};
