<?php
include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    
    // Jika gambar diubah
    if ($gambar) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        
        $query = $conn->prepare("UPDATE produk SET nama_produk = ?, harga = ?, gambar = ? WHERE id = ?");
        $query->execute([$nama_produk, $harga, $gambar, $id]);
    } else {
        $query = $conn->prepare("UPDATE produk SET nama_produk = ?, harga = ? WHERE id = ?");
        $query->execute([$nama_produk, $harga, $id]);
    }
    
    header("Location: lihatdata.php");
}
?>
