<?php
// Detail Koneksi Database dari InfinityFree
$host = "localhost"; // MySQL Hostname
$user = "salmasho_salmasho_db";           // MySQL Username
$pass = "SalmaShofa123";            // MySQL Password
$db  = "salmasho_db_salmashofa"; // Nama Database

$koneksi = mysqli_connect($host, $user, $pass, $db);

// BARIS AJAIB: Menyamakan bahasa (encoding) antara PHP dan MySQL
mysqli_set_charset($koneksi, "utf8mb4");

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>