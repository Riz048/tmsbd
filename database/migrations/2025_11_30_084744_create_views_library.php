<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW v_laporan_peminjaman AS
            SELECT
                p.id AS peminjaman_id,
                p.tanggal_pinjam,
                p.lama_pinjam,
                p.status,
                u.id_user,
                u.nama AS nama_anggota,
                pg.id_pegawai,
                pg.status AS status_petugas,
                d.id AS detail_id,
                b.id AS buku_id,
                b.judul,
                d.jumlah
            FROM peminjaman p
            JOIN `user` u ON u.id_user = p.id_user
            LEFT JOIN petugas pg ON pg.id_pegawai = p.id_pegawai
            JOIN peminjaman_detail d ON d.peminjaman_id = p.id
            JOIN buku b ON b.id = d.buku_id
        ");

        DB::statement("
            CREATE VIEW v_laporan_pengembalian AS
            SELECT
                g.id AS pengembalian_id,
                g.tanggal_kembali,
                p.id AS peminjaman_id,
                p.tanggal_pinjam,
                p.lama_pinjam,
                u.id_user,
                u.nama AS nama_anggota,
                DATEDIFF(
                    g.tanggal_kembali,
                    DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY)
                ) AS hari_terlambat,
                CASE
                    WHEN DATEDIFF(
                        g.tanggal_kembali,
                        DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY)
                    ) <= 0 THEN 'Tepat Waktu'
                    ELSE 'Terlambat'
                END AS status_keterlambatan
            FROM pengembalian g
            JOIN peminjaman p ON p.id = g.peminjaman_id
            JOIN `user` u ON u.id_user = g.id_user
        ");

        DB::statement("CREATE VIEW v_buku_tersedia AS SELECT * FROM buku WHERE jlh_buku > 0");

        DB::statement("
            CREATE VIEW v_anggota_aktif AS
            SELECT DISTINCT u.*
            FROM peminjaman p
            JOIN `user` u ON u.id_user = p.id_user
            WHERE p.status = 'dipinjam'
        ");

        DB::statement("
            CREATE VIEW v_statistik_bulanan AS
            SELECT
                YEAR(tanggal_pinjam) AS tahun,
                MONTH(tanggal_pinjam) AS bulan,
                COUNT(*) AS jumlah_peminjaman
            FROM peminjaman
            GROUP BY YEAR(tanggal_pinjam), MONTH(tanggal_pinjam)
        ");

        DB::statement("CREATE VIEW v_buku_rusak AS SELECT * FROM buku WHERE status_buku = 'rusak'");

        DB::statement("
            CREATE VIEW v_riwayat_petugas AS
            SELECT
                pg.id_pegawai,
                pg.status AS status_petugas,
                COUNT(DISTINCT p.id) AS total_peminjaman,
                COUNT(DISTINCT g.id) AS total_pengembalian
            FROM petugas pg
            LEFT JOIN peminjaman p ON p.id_pegawai = pg.id_pegawai
            LEFT JOIN pengembalian g ON g.peminjaman_id = p.id
            GROUP BY pg.id_pegawai, pg.status
        ");

        DB::statement("CREATE VIEW v_daftar_siswa AS SELECT * FROM `user` WHERE role = 'siswa'");

        DB::statement("
            CREATE VIEW v_kepatuhan_pengembalian AS
            SELECT
                u.id_user,
                u.nama,
                p.id AS peminjaman_id,
                p.tanggal_pinjam,
                p.lama_pinjam,
                g.tanggal_kembali,
                DATEDIFF(
                    g.tanggal_kembali,
                    DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY)
                ) AS hari_terlambat,
                CASE
                    WHEN g.tanggal_kembali IS NULL THEN 'Belum dikembalikan'
                    WHEN DATEDIFF(
                        g.tanggal_kembali,
                        DATE_ADD(p.tanggal_pinjam, INTERVAL p.lama_pinjam DAY)
                    ) <= 0 THEN 'Tepat Waktu'
                    ELSE 'Terlambat'
                END AS status_kepatuhan
            FROM peminjaman p
            JOIN `user` u ON u.id_user = p.id_user
            LEFT JOIN pengembalian g ON g.peminjaman_id = p.id
        ");

        DB::statement("
            CREATE VIEW v_log_status_buku AS
            SELECT
                l.id,
                l.created_at,
                b.id AS buku_id,
                b.judul,
                l.status_lama,
                l.status_baru,
                u.id_user,
                u.nama AS nama_user,
                l.keterangan
            FROM log_status_buku l
            JOIN buku b ON b.id = l.buku_id
            LEFT JOIN `user` u ON u.id_user = l.user_id
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS v_laporan_peminjaman");
        DB::statement("DROP VIEW IF EXISTS v_laporan_pengembalian");
        DB::statement("DROP VIEW IF EXISTS v_buku_tersedia");
        DB::statement("DROP VIEW IF EXISTS v_anggota_aktif");
        DB::statement("DROP VIEW IF EXISTS v_statistik_bulanan");
        DB::statement("DROP VIEW IF EXISTS v_buku_rusak");
        DB::statement("DROP VIEW IF EXISTS v_riwayat_petugas");
        DB::statement("DROP VIEW IF EXISTS v_daftar_siswa");
        DB::statement("DROP VIEW IF EXISTS v_kepatuhan_pengembalian");
        DB::statement("DROP VIEW IF EXISTS v_log_status_buku");
    }
};
