<?php
// index.php

// Panggil koneksi dan semua kelas yang diperlukan
require_once 'koneksi.php';
require_once 'karyawan.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

// 1. Ambil data mentah dari database menggunakan metode statis masing-masing kelas
$dataTetap   = KaryawanTetap::getDaftarTetap($pdo);
$dataKontrak = KaryawanKontrak::getDaftarKontrak($pdo);
$dataMagang  = KaryawanMagang::getDaftarMagang($pdo);

// 2. Instansiasi data mentah menjadi kumpulan Objek (Polimorfisme)
$listKaryawanTetap = [];
foreach ($dataTetap as $row) {
    $listKaryawanTetap[] = new KaryawanTetap(
        $row['id_karyawan'], $row['nama_karyawan'], $row['tanggal_masuk'], $row['performa_nilai'], $row['gaji_dasar'],
        $row['tunjangan_jabatan'], $row['bonus_tahunan']
    );
}

$listKaryawanKontrak = [];
foreach ($dataKontrak as $row) {
    $listKaryawanKontrak[] = new KaryawanKontrak(
        $row['id_karyawan'], $row['nama_karyawan'], $row['tanggal_masuk'], $row['performa_nilai'], $row['gaji_dasar'],
        $row['durasi_kontrak_bulan'], $row['nama_proyek']
    );
}

$listKaryawanMagang = [];
foreach ($dataMagang as $row) {
    // Gaji dasar dilempar 0 sesuai struktur kelas anak Magang
    $listKaryawanMagang[] = new KaryawanMagang(
        $row['id_karyawan'], $row['nama_karyawan'], $row['tanggal_masuk'], $row['performa_nilai'], 0,
        $row['insentif_magang'], $row['asal_campus'] ?? $row['asal_kampus']
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-amber-50/40 min-h-screen text-slate-800">

    <div class="max-w-7xl mx-auto px-4 py-10">
        
        <header class="mb-10 text-center md:text-left">
            <span class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full assignment-badge">Sistem Informasi SDM</span>
            <h1 class="text-3xl font-bold text-slate-900 mt-2">Manajemen Dashboard Karyawan</h1>
            <p class="text-slate-500 mt-1 text-sm md:text-base">Data penggajian dan fasilitas karyawan terintegrasi secara polimorfik.</p>
        </header>

        <section class="mb-12 bg-white rounded-2xl shadow-sm border border-cyan-100 overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-5 text-white">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span>💼 Karyawan Tetap</span>
                    <span class="bg-white/20 text-xs px-2.5 py-0.5 rounded-full font-medium"><?= count($listKaryawanTetap) ?> Orang</span>
                </h2>
                <p class="text-cyan-50 text-xs mt-0.5">Komponen Gaji: Gaji Dasar + Tunjangan Jabatan + Bonus Tahunan</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase text-slate-500 tracking-wider">
                            <th class="p-4">ID / Nama</th>
                            <th class="p-4">Tanggal Masuk</th>
                            <th class="p-4 text-center">Performa</th>
                            <th class="p-4 text-right">Take-Home Pay</th>
                            <th class="p-4">Fasilitas & Benefit Ekstra</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php foreach($listKaryawanTetap as $k): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4">
                                <div class="font-bold text-slate-900"><?= $k->getIdKaryawan() ?></div>
                                <div class="text-xs text-slate-500"><?= $k->getNamaKaryawan() ?></div>
                            </td>
                            <td class="p-4 text-slate-600"><?= date('d M Y', strtotime($k->getTanggalMasuk())) ?></td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg <?= $k->getPerformaNilai() >= 85 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' ?>">
                                    <?= $k->getPerformaNilai() ?>
                                </span>
                            </td>
                            <td class="p-4 text-right font-semibold text-blue-600">
                                Rp <?= number_format($k->hitungTotalGaji(), 2, ',', '.') ?>
                            </td>
                            <td class="p-4">
                                <div class="flex flex-wrap gap-1">
                                    <?php foreach($k->tampilkanFasilitas() as $f): ?>
                                        <span class="bg-cyan-50 text-cyan-700 text-[11px] px-2 py-0.5 rounded border border-cyan-100 font-medium">✓ <?= $f ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="mb-12 bg-white rounded-2xl shadow-sm border border-amber-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-5 text-white">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span>📄 Karyawan Kontrak</span>
                    <span class="bg-white/20 text-xs px-2.5 py-0.5 rounded-full font-medium"><?= count($listKaryawanKontrak) ?> Orang</span>
                </h2>
                <p class="text-amber-50 text-xs mt-0.5">Komponen Gaji: Gaji Dasar + Uang Kehadiran Flat (Rp100.000)</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase text-slate-500 tracking-wider">
                            <th class="p-4">ID / Nama</th>
                            <th class="p-4">Tanggal Masuk</th>
                            <th class="p-4 text-center">Performa</th>
                            <th class="p-4 text-right">Take-Home Pay</th>
                            <th class="p-4">Fasilitas & Benefit Ekstra</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php foreach($listKaryawanKontrak as $k): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4">
                                <div class="font-bold text-slate-900"><?= $k->getIdKaryawan() ?></div>
                                <div class="text-xs text-slate-500"><?= $k->getNamaKaryawan() ?></div>
                            </td>
                            <td class="p-4 text-slate-600"><?= date('d M Y', strtotime($k->getTanggalMasuk())) ?></td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg <?= $k->getPerformaNilai() >= 85 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' ?>">
                                    <?= $k->getPerformaNilai() ?>
                                </span>
                            </td>
                            <td class="p-4 text-right font-semibold text-amber-600">
                                Rp <?= number_format($k->hitungTotalGaji(), 2, ',', '.') ?>
                            </td>
                            <td class="p-4">
                                <div class="flex flex-wrap gap-1">
                                    <?php foreach($k->tampilkanFasilitas() as $f): ?>
                                        <span class="bg-amber-50 text-amber-800 text-[11px] px-2 py-0.5 rounded border border-amber-200 font-medium">✓ <?= $f ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="bg-white rounded-2xl shadow-sm border border-purple-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-5 text-white">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span>🎓 Karyawan Magang</span>
                    <span class="bg-white/20 text-xs px-2.5 py-0.5 rounded-full font-medium"><?= count($listKaryawanMagang) ?> Orang</span>
                </h2>
                <p class="text-purple-50 text-xs mt-0.5">Komponen Gaji: Murni Akumulasi Insentif Uang Saku Magang</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-xs font-semibold uppercase text-slate-500 tracking-wider">
                            <th class="p-4">ID / Nama</th>
                            <th class="p-4">Tanggal Masuk</th>
                            <th class="p-4 text-center">Performa</th>
                            <th class="p-4 text-right">Take-Home Pay</th>
                            <th class="p-4">Fasilitas & Benefit Ekstra</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php foreach($listKaryawanMagang as $k): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4">
                                <div class="font-bold text-slate-900"><?= $k->getIdKaryawan() ?></div>
                                <div class="text-xs text-slate-500"><?= $k->getNamaKaryawan() ?></div>
                            </td>
                            <td class="p-4 text-slate-600"><?= date('d M Y', strtotime($k->getTanggalMasuk())) ?></td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg <?= $k->getPerformaNilai() >= 85 ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' ?>">
                                    <?= $k->getPerformaNilai() ?>
                                </span>
                            </td>
                            <td class="p-4 text-right font-semibold text-purple-600">
                                Rp <?= number_format($k->hitungTotalGaji(), 2, ',', '.') ?>
                            </td>
                            <td class="p-4">
                                <div class="flex flex-wrap gap-1">
                                    <?php foreach($k->tampilkanFasilitas() as $f): ?>
                                        <span class="bg-purple-50 text-purple-700 text-[11px] px-2 py-0.5 rounded border border-purple-100 font-medium">✓ <?= $f ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>

</body>
</html>