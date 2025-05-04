<?php
include 'config/database.php'; // Pastikan koneksi database ada

$q = $_GET['q'] ?? '';
$q = trim(mysqli_real_escape_string($koneksi, $q));

// Cek di tabel pelanggan
$c1 = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE nama_pelanggan LIKE '%$q%'");
if (mysqli_num_rows($c1) > 0) {
    header("Location: index.php?page=pelanggan&cari=$q");
    exit;
}

// Cek di tabel produk
$c2 = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk LIKE '%$q%'");
if (mysqli_num_rows($c2) > 0) {
    header("Location: index.php?page=produk&cari=$q");
    exit;
}

// Cek di tabel pembelian (misalnya cari berdasarkan tanggal)
$c3 = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$q%'");
if (mysqli_num_rows($c3) > 0) {
    header("Location: index.php?page=pembelian&cari=$q");
    exit;
}

// Jika tidak ditemukan
echo "Data '$q' tidak ditemukan di sistem.";
