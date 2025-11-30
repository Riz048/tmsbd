<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            CREATE FUNCTION fn_total_pinjam(p_id_anggota INT)
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE v_total INT;

                SELECT COALESCE(SUM(d.jumlah), 0)
                INTO v_total
                FROM peminjaman p
                JOIN peminjaman_detail d ON d.peminjaman_id = p.id
                WHERE p.id_user = p_id_anggota
                AND p.status = 'dipinjam';

                RETURN v_total;
            END
        ");

        DB::unprepared("
            CREATE FUNCTION fn_status_keterlambatan(p_id_peminjaman INT)
            RETURNS VARCHAR(50)
            DETERMINISTIC
            BEGIN
                DECLARE v_tanggal_pinjam DATE;
                DECLARE v_lama_pinjam INT;
                DECLARE v_jatuh_tempo DATE;
                DECLARE v_tanggal_kembali DATE;
                DECLARE v_selisih INT;

                SELECT tanggal_pinjam, lama_pinjam
                INTO v_tanggal_pinjam, v_lama_pinjam
                FROM peminjaman
                WHERE id = p_id_peminjaman;

                IF v_tanggal_pinjam IS NULL THEN
                    RETURN 'Data peminjaman tidak ditemukan';
                END IF;

                SET v_jatuh_tempo = DATE_ADD(v_tanggal_pinjam, INTERVAL v_lama_pinjam DAY);

                SELECT tanggal_kembali
                INTO v_tanggal_kembali
                FROM pengembalian
                WHERE peminjaman_id = p_id_peminjaman
                ORDER BY id DESC LIMIT 1;

                IF v_tanggal_kembali IS NULL THEN
                    SET v_tanggal_kembali = CURDATE();
                END IF;

                SET v_selisih = DATEDIFF(v_tanggal_kembali, v_jatuh_tempo);

                IF v_selisih <= 0 THEN
                    RETURN 'Tepat Waktu';
                ELSE
                    RETURN CONCAT('Terlambat ', v_selisih, ' hari');
                END IF;
            END
        ");

        DB::unprepared("
            CREATE FUNCTION fn_sisa_stok(p_id_buku INT)
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE v_stok INT;

                SELECT jlh_buku INTO v_stok FROM buku WHERE id = p_id_buku;

                RETURN COALESCE(v_stok, 0);
            END
        ");

        DB::unprepared("
            CREATE FUNCTION fn_jumlah_buku_rusak()
            RETURNS INT
            DETERMINISTIC
            BEGIN
                DECLARE v_total INT;

                SELECT COUNT(*) INTO v_total FROM buku WHERE status_buku = 'rusak';

                RETURN v_total;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS fn_total_pinjam");
        DB::unprepared("DROP FUNCTION IF EXISTS fn_status_keterlambatan");
        DB::unprepared("DROP FUNCTION IF EXISTS fn_sisa_stok");
        DB::unprepared("DROP FUNCTION IF EXISTS fn_jumlah_buku_rusak");
    }
};
