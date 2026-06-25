<?php
// KaryawanTetap.php

require_once 'karyawan.php';

class KaryawanTetap extends Karyawan {
    // Properti tambahan spesifik
    private $tunjanganJabatan;
    private $bonusTahunan;

    // Constructor mencakup parameter induk + parameter anak
    public function __construct(
        $id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar,
        $tunjanganJabatan, $bonusTahunan
    ) {
        // Memanggil constructor dari abstract class induk
        parent::__construct($id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar);
        $this->tunjanganJabatan = $tunjanganJabatan;
        $this->bonusTahunan = $bonusTahunan;
    }

    // Implementasi metode abstrak dari induk
    public function hitungTotalGaji() {
        // Gaji dasar + tunjangan jabatan
        return $this->gajiDasar + $this->tunjanganJabatan;
    }

    public function tampilkanFasilitas() {
        return [
            "Asuransi Kesehatan Swasta (Full Cover)",
            "Dana Pensiun (BPJS Ketenagakerjaan JHT & JP)",
            "Hak Cuti Tahunan 12 Hari",
            "Bonus Kinerja Tahunan"
        ];
    }

    // Metode Query Spesifik menggunakan PDO
    public static function getDaftarTetap($db) {
        $sql = "SELECT id_karyawan, nama_karyawan, tanggal_masuk, performa_nilai, gaji_dasar, 
                       tunjangan_jabatan, bonus_tahunan 
                FROM tabel_karyawan 
                WHERE status_karyawan = 'Tetap'";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}