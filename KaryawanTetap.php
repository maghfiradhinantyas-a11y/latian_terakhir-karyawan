<?php
// KaryawanTetap.php

require_once 'karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjanganJabatan;
    private $bonusTahunan;

    public function __construct(
        $id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar,
        $tunjanganJabatan, $bonusTahunan
    ) {
        parent::__construct($id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar);
        $this->tunjanganJabatan = $tunjanganJabatan;
        $this->bonusTahunan = $bonusTahunan;
    }

    /**
     * OVERRIDING: Karyawan Tetap mendapatkan komponen gaji penuh
     * Total Gaji = gajiDasar + tunjanganJabatan + bonusTahunan
     */
    public function hitungTotalGaji() {
        return $this->gajiDasar + $this->tunjanganJabatan + $this->bonusTahunan;
    }

    public function tampilkanFasilitas() {
        return [
            "Asuransi Kesehatan Swasta (Full Cover)",
            "Dana Pensiun (BPJS Ketenagakerjaan JHT & JP)",
            "Hak Cuti Tahunan 12 Hari",
            "Bonus Kinerja Tahunan"
        ];
    }

    public static function getDaftarTetap($db) {
        $sql = "SELECT id_karyawan, nama_karyawan, tanggal_masuk, performa_nilai, gaji_dasar, 
                       tunjangan_jabatan, bonus_tahunan 
                FROM tabel_karyawan 
                WHERE status_karyawan = 'Tetap'";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}