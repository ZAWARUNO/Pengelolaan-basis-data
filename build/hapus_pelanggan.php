<?php
include 'config/database.php';

$id = $_GET['id'];

$query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script> window.location='?page=pelanggan';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!');</script>";
}