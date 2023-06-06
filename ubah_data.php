<?php
session_start();

require 'function.php';

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

$id = $_GET["id"];

$data = liatdata("SELECT * FROM menu_toko WHERE id = $id")[0];

if (isset($_POST["submit"])) {
  if (ubahdata($_POST) > 0) {
    ?><script type="text/javascript">alert('Anda Berhasil Mengupdate Data Ini');
    document.location.href='index.php';</script> <?php
  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Data</title>
    <link rel="stylesheet" href="css/tambahdata.css">
  </head>
  <body>
    <h1>Update Data</h1>
    <form class="" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $data["id"]; ?>">
      <input type="hidden" name="photolama" value="<?= $data["photo_menu"]; ?>">

      <label for="kodemenu">Kode menu : </label>
      <input type="text" name="kodemenu" id="kodemenu" autocomplete="off" required placeholder="contoh:Km001" value="<?= $data["kode_menu"]; ?>">
      <br><br>
      <label for="namamenu">Nama menu : </label>
      <input type="text" name="namamenu" id="namamenu" autocomplete="off" required placeholder="contoh:Nasi Goreng" value="<?= $data["nama_menu"]; ?>">
      <br><br>
      <label for="hargamenu">Harga menu : </label>
      <input type="text" name="hargamenu" id="hargamenu" autocomplete="off" required placeholder="contoh:20000" value="<?= $data["harga_menu"]; ?>">
      <br><br>
      <label for="photomenu">Photo menu : </label>
      <input type="file" name="photomenu" id="photomenu" autocomplete="off" placeholder="contoh:nophoto.png">
      <br><br><br>
      <button type="submit" name="submit">Update Data</button>
    </form>
    <br><br>
    <a href="index.php">Kembali</a>
  </body>
</html>
