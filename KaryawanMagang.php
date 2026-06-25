<?php
// KaryawanMagang.php

require_once 'karyawan.php';

class KaryawanMagang extends Karyawan {
    private $insentifMagang;
    private $asalKampus;

    public function __construct(
        $id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar,
        $insentifMagang, $asalKampus
    ) {
        parent::__construct($id_karyawan, $nama_karyawan, $tanggal_masuk, $performa_nilai, $gajiDasar);
        $this->insentifMagang = $insentifMagang;
        $this->asalKampus = $asalKampus;
    }

    /**
     * OVERRIDING: Karyawan Magang tidak menerima gaji dasar perusahaan
     * Total Gaji = insentifMagang saja
     */
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

    public static function getDaftarMagang($db) {
        $sql = "SELECT id_karyawan, nama_karyawan, tanggal_masuk, performa_nilai, 
                       insentif_magang, asal_kampus 
                FROM tabel_karyawan 
                WHERE status_karyawan = 'Magang'";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}