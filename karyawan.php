<?php
// karyawan.php

abstract class Karyawan {
    // Properti Terenkapsulasi (Protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $tanggal_masuk;
    protected $performa_nilai;
    protected $gajiDasar;

    // Constructor untuk memetakan data dari kolom tabel database
    public function __construct(
        $id_karyawan, 
        $nama_karyawan, 
        $tanggal_masuk, 
        $performa_nilai, 
        $gajiDasar
    ) {
        $this->id_karyawan    = $id_karyawan;
        $this->nama_karyawan  = $nama_karyawan;
        $this->tanggal_masuk  = $tanggal_masuk;
        $this->performa_nilai = $performa_nilai;
        $this->gajiDasar      = $gajiDasar;
    }

    // Getter (Opsional - berguna jika kelas luar perlu membaca data terlindungi ini)
    public function getIdKaryawan() { return $this->id_karyawan; }
    public function getNamaKaryawan() { return $this->nama_karyawan; }
    public function getTanggalMasuk() { return $this->tanggal_masuk; }
    public function getPerformaNilai() { return $this->performa_nilai; }
    public function getGajiDasar() { return $this->gajiDasar; }

    // METODE ABSTRAK (Wajib diimplementasikan oleh kelas anak)
    
    /**
     * Menghitung total gaji akhir berdasarkan perhitungan spesifik per status karyawan.
     * @return float
     */
    abstract public function hitungTotalGaji();

    /**
     * Menampilkan daftar fasilitas atau benefit spesifik yang didapatkan karyawan.
     * @return array/string
     */
    abstract public function tampilkanFasilitas();
}