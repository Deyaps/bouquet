<?php
include "../connect.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menghapus gambar dari direktori
    $query = $conn->prepare("SELECT gambar FROM produk WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $data = $query->fetch();
    if ($data) {
        $gambar = $data['gambar'];
        if (file_exists("image/$gambar")) {
            unlink("image/$gambar");
        }
    }

    // Menghapus data dari database
    $query = $conn->prepare("DELETE FROM produk WHERE id = :id");
    $query->bindParam(':id', $id);
    if ($query->execute()) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data.";
    }
    header("Location: lihatdata.php"); // Ganti dengan file utama Anda
} else {
    echo "ID tidak ditemukan.";
} 
?>