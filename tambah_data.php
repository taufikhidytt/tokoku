<?php
session_start();

require 'function.php';

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

if (isset($_POST["submit"])) {
  if (tambahdata($_POST) > 0) {
    ?><script type="text/javascript">alert('Anda Berhasil Menambahkan Data Baru');
    document.location.href='index.php';</script> <?php
  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="css/tambahdata.css">
  </head>
  <body>
    <h1>Tambah Data</h1>
    <form class="" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="photodefult" value="nophoto.png">

      <label for="kodemenu">Kode menu : </label>
      <input type="text" name="kodemenu" id="kodemenu" autocomplete="off" required placeholder="contoh:Km001">
      <br><br>
      <label for="namamenu">Nama menu : </label>
      <input type="text" name="namamenu" id="namamenu" autocomplete="off" required placeholder="contoh:Nasi Goreng">
      <br><br>
      <label for="hargamenu">Harga menu : </label>
      <input type="text" name="hargamenu" id="hargamenu" autocomplete="off" required placeholder="contoh:20000">
      <br><br>
      <label for="photomenu">Photo menu : </label>
      <input type="file" name="photomenu" id="photomenu" autocomplete="off" placeholder="contoh:nophoto.png">
      <br><br><br>
      <button type="submit" name="submit">Tambah Data</button>
    </form>
    <br><br>
    <a href="index.php">Kembali</a>
  </body>
</html>
