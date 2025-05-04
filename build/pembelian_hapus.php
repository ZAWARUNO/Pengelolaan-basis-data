<?php
include 'config/database.php';
$id = $_GET['id'];


$query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan='$id'");

if ($query) {
    echo "<script> window.location='?page=pembelian';</script>";
} else {
    echo "<script> alert('Gagal menghapus data!');</script>";
}