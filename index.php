<?php
session_start();

require 'function.php';

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

$data = liatdata("SELECT * FROM menu_toko");

if (isset($_POST["submit"])) {
  $data = caridata($_POST["cari"]);
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Daftar Menu</title>
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <h1>Daftar Menu</h1>
    <h3><a href="tambah_data.php">Tambah Data</a> </h3>
    <form class="" action="" method="post">
      <input type="text" name="cari" placeholder="Cari Data Anda" autocomplete="off">
      <button type="submit" name="submit">Mencari Data</button>
      <a href="logout.php">Logout</a>
    </form>
    <table border="5" cellpadding="10" cellspacing="0" align="center">
      <tr>
        <th>No</th>
        <th>Photo Menu</th>
        <th>Kode Menu</th>
        <th>Nama Menu</th>
        <th>Harga Menu (Rp)</th>
        <th>Aksi</th>
      </tr>
      <?php foreach ($data as $dt): ?>
      <tr>
        <td><?= $dt["id"]; ?></td>
        <td><img src="img/<?= $dt["photo_menu"]; ?>" alt="photo" width="70"></td>
        <td><?= $dt["kode_menu"]; ?></td>
        <td><?= $dt["nama_menu"]; ?></td>
        <td><?= $dt["harga_menu"]; ?></td>
        <td>
          <a href="ubah_data.php?id=<?= $dt["id"]; ?>" onclick="return confirm('Apakah Anda Ingin Mengupdate Data Ini?')">Update</a>    |
          <a href="hapus_data.php?id=<?= $dt["id"]; ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </table>
  </body>
</html>
