<?php
// KaryawanMagang.php

require_once 'karyawan.php';

class KaryawanMagang extends Karyawan {
    // Properti tambahan spesifik
    private $insentifMagang;
    private $asalKampus;

    public function __construct(
        $id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar,
        $insentifMagang, $asalKampus
    ) {
        // Gaji dasar diisi 0 karena magang murni menggunakan insentifMagang
        parent::__construct($id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar);
        $this->insentifMagang = $insentifMagang;
        $this->asalKampus = $asalKampus;
    }

    // Implementasi metode abstrak dari induk
    public function hitungTotalGaji() {
        return $this->insentifMagang;
    }

    public function tampilkanFasilitas() {
        return [
            "Sertifikat Magang Resmi",
            "Akses Pelatihan & Mentorship Eksklusif",
            "Makan Siang Gratis di Kantor"
        ];
    }

    // Metode Query Spesifik menggunakan PDO
    public static function getDaftarMagang($db) {
        $sql = "SELECT id_karyawan, nama_karyawan, tanggal_masuk, performa_nilai, 
                       insentif_magang, asal_kampus 
                FROM tabel_karyawan 
                WHERE status_karyawan = 'Magang'";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}