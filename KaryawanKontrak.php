<?php
// KaryawanKontrak.php

require_once 'karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasiKontrakBulan;
    private $namaProyek;

    public function __construct(
        $id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar,
        $durasiKontrakBulan, $namaProyek
    ) {
        parent::__construct($id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->namaProyek = $namaProyek;
    }

    /**
     * OVERRIDING: Karyawan Kontrak mendapatkan uang kehadiran flat Rp100.000
     * Total Gaji = gajiDasar + 100000
     */
    public function hitungTotalGaji() {
        return $this->gajiDasar + 100000;
    }

    public function tampilkanFasilitas() {
        return [
            "BPJS Ketenagakerjaan",
            "Tunjangan Komunikasi Proyek",
            "Laptop Inventaris Perusahaan"
        ];
    }

    public static function getDaftarKontrak($db) {
        $sql = "SELECT id_karyawan, nama_karyawan, tanggal_masuk, performa_nilai, gaji_dasar, 
                       durasi_kontrak_bulan, nama_proyek 
                FROM tabel_karyawan 
                WHERE status_karyawan = 'Kontrak'";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}