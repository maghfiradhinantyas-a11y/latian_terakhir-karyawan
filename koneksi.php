<?php
// koneksi.php

$host     = 'localhost';
$db_name  = 'db_karyawan_fira.sql'; // Silakan sesuaikan dengan nama DB Anda
$username = 'root';
$password = ''; // Silakan sesuaikan dengan password DB Anda
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mengubah error menjadi Exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Hasil fetch berupa array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Menonaktifkan emulasi prepared statements demi keamanan
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Menghentikan skrip dan menampilkan pesan jika koneksi gagal
    die("Koneksi database gagal: " . $e->getMessage());
}