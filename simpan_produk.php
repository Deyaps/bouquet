<?php
include "../connect.php";
include "layout/header.php";

if (isset($_POST['simpanproduk'])) {
    // Menyiapkan query untuk menyimpan data
    $query = "INSERT INTO produk (nama_produk, harga, gambar) VALUES (:nama_produk, :harga, :gambar)";

    // Menyiapkan statement PDO
    $statement = $conn->prepare($query);

    // Bind parameter ke nilai aktual
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];

    // Cek apakah file gambar telah diunggah dengan benar
    if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        // Move uploaded file to desired location
        $target_directory = "img/"; // Directory where you want to store uploaded files
        $target_file = $target_directory . basename($_FILES['gambar']['name']);

        if (!file_exists($target_directory)) {
            mkdir($target_directory, 0777, true);
        }

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Bind parameter ke statement
            $gambar = basename($_FILES['gambar']['name']);
            $statement->bindParam(':gambar', $gambar);
        } else {
            die("Gagal memindahkan file gambar.");
        }
    } else {
        die("Gagal mengunggah file gambar.");
    }

    // Bind parameter ke statement
    $statement->bindParam(':nama_produk', $nama_produk);
    $statement->bindParam(':harga', $harga);

    // Eksekusi statement untuk menyimpan data
    try {
        $statement->execute();
        // echo "Data berhasil disimpan.";
        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        die("Gagal menyimpan data: " . $e->getMessage());
    }
}
?>

<?php
include "../layout/footer.php";
?>