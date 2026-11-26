<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: pelanggan.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>