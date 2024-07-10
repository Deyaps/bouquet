<?php
include "../connect.php";
include "../layout/header.php";
include "layout/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM produk WHERE id = ?");
    $query->execute([$id]);
    $data = $query->fetch();
}
?>

<div class="container">
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo $data['status']; ?>" required>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar:</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            <br>
            <img src="img/<?php echo $data['gambar']; ?>" width="150" height="150">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php
include "../layout/footer.php";
include "../layout/footer.php";
?>
