<?php
session_start();

require 'function.php';

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

$id = $_GET["id"];

if (hapusdata($id) > 0) {
  ?><script type="text/javascript">alert('Anda Berhasil Menghapus Data Ini');
  document.location.href='index.php';</script> <?php
}

 ?>
