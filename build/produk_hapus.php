<?php
include 'config/database.php';
$id = $_GET['id'];


$query = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id'");

if ($query) {
    echo "<script> window.location='?page=produk';</script>";
} else {
    echo "<script> alert('Gagal menghapus data!');</script>";
}