<?php
include "../connect.php";
include "layout/header.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

// Mengambil jumlah data produk dari database
$query = $conn->prepare("SELECT COUNT(*) as total FROM produk");
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$totalProduk = $result['total'];
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title">Jumlah Produk yang Tersedia</h1>
        </div>
        <div class="card-body">
            <h2 class="card-text">Total: <?php echo $totalProduk; ?> produk</h2>
        </div>
        <div class="card-footer">
            <a href="lihatdata.php" class="btn btn-outline-primary"><i class="fas fa-eye"></i> Lihat Data Produk</a>
        </div>
    </div>
</div>

<?php
include "../layout/footer.php";
?>
