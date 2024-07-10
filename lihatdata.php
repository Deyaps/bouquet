<?php
include "../connect.php";
include "layout/header.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

?>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Gambar</th>
      <th scope="col">Nama File</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $no=1;
        $query=$conn->prepare("SELECT * FROM produk order by id desc");
        $query->execute();
        while($data=$query->fetch()){?>
        <tr>
        <td><?php echo $no++; ?></td>
                    <td><img src="img/<?php echo $data['gambar'] ?>" width="150" height="150"></td>
                    <td><?php echo $data['gambar'] ?></td>
                    <td><?php echo $data['nama_produk'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td><?php echo $data['deskripsi'] ?></td>
                    <td><?php echo $data['status'] ?></td>
                    <td>
            <a href="edit.php?id=<?php echo $data['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen"></i> Edit</a>
            <button type="button" class="btn btn-danger" onclick="confirmdeletion(<?php echo $data['id']?>)"><i class="fa-solid fa-trash-can"></i> Hapus</button>
            </td>
        </tr>

        <?php } ?>
  </tbody>
</table>
</div>

<script>
    function confirmdeletion(id) {
        if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
            window.location.href = "hapusdata.php?id=" + id;
        }
    }
</script>

<?php
include "../layout/footer.php";
?>