<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE PROCEDURE sp_tambah_peminjaman(
                IN p_id_anggota INT,
                IN p_id_buku INT,
                IN p_jumlah INT
            )
            BEGIN
                DECLARE v_peminjaman_id INT;

                INSERT INTO peminjaman (
                    tanggal_pinjam, lama_pinjam, keterangan,
                    status, id_user, id_pegawai
                )
                VALUES (CURDATE(), 7, NULL, 'dipinjam', p_id_anggota, NULL);

                SET v_peminjaman_id = LAST_INSERT_ID();

                INSERT INTO peminjaman_detail (peminjaman_id, buku_id, jumlah)
                VALUES (v_peminjaman_id, p_id_buku, p_jumlah);
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_pengembalian_buku(
                IN p_id_peminjaman INT,
                IN p_tgl_kembali DATE,
                IN p_status_pengembalian VARCHAR(20)
            )
            BEGIN
                DECLARE v_id_user INT;

                SELECT id_user INTO v_id_user FROM peminjaman WHERE id = p_id_peminjaman;

                INSERT INTO pengembalian (peminjaman_id, tanggal_kembali, id_user, foto_bukti)
                VALUES (p_id_peminjaman, p_tgl_kembali, v_id_user, NULL);

                IF p_status_pengembalian IN ('rusak','hilang') THEN
                    UPDATE buku b
                    JOIN peminjaman_detail d ON d.buku_id = b.id
                    SET b.status_buku = p_status_pengembalian
                    WHERE d.peminjaman_id = p_id_peminjaman;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_backup_data()
            BEGIN
                INSERT INTO arsip_buku SELECT * FROM buku;
                INSERT INTO arsip_peminjaman SELECT * FROM peminjaman;
                INSERT INTO arsip_pengembalian SELECT * FROM pengembalian;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_laporan_bulanan(IN p_bulan INT, IN p_tahun INT)
            BEGIN
                SELECT * FROM v_laporan_peminjaman
                WHERE MONTH(tanggal_pinjam)=p_bulan AND YEAR(tanggal_pinjam)=p_tahun;

                SELECT * FROM v_laporan_pengembalian
                WHERE MONTH(tanggal_kembali)=p_bulan AND YEAR(tanggal_kembali)=p_tahun;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_notifikasi_terlambat()
            BEGIN
                INSERT INTO notifikasi_terlambat (id_user, id_peminjaman, hari_terlambat)
                SELECT
                    p.id_user,
                    p.id,
                    DATEDIFF(CURDATE(), DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY))
                FROM peminjaman p
                LEFT JOIN pengembalian g ON g.peminjaman_id = p.id
                WHERE g.id IS NULL
                AND DATEDIFF(CURDATE(), DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY)) > 0;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE sp_update_kondisi_buku(
                IN p_id_peminjaman_detail INT,
                IN p_kondisi_baru ENUM('baik','rusak','hilang')
            )
            BEGIN
                DECLARE v_buku_id INT;
                DECLARE v_status_lama ENUM('baik','rusak','hilang');

                SELECT d.buku_id, b.status_buku
                INTO v_buku_id, v_status_lama
                FROM peminjaman_detail d
                JOIN buku b ON b.id = d.buku_id
                WHERE d.id = p_id_peminjaman_detail;

                IF v_buku_id IS NOT NULL THEN
                    UPDATE buku
                    SET status_buku = p_kondisi_baru
                    WHERE id = v_buku_id;

                    INSERT INTO log_status_buku (buku_id, user_id, status_lama, status_baru, keterangan)
                    VALUES (
                        v_buku_id,
                        NULL,
                        v_status_lama,
                        p_kondisi_baru,
                        CONCAT('Update via sp_update_kondisi_buku, detail id ', p_id_peminjaman_detail)
                    );
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_tambah_peminjaman");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_pengembalian_buku");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_backup_data");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_laporan_bulanan");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_notifikasi_terlambat");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_kondisi_buku");
    }
};
