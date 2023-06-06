<?php
session_start();

require 'function.php';

if (isset($_SESSION["login"])) {
  header("location: index.php");
  exit;
}

if (isset($_POST["submit"])) {
  if (registrasi($_POST) > 0) {
    ?><script type="text/javascript">alert('Anda Berhasil Mendaftarkan Akun Anda');
    document.location.href='index.php';</script> <?php
  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/registrasi.css">
  </head>
  <body>
    <h1>Sign Up</h1><hr>
    <form class="" action="" method="post">
      <label for="username">Masukan Username :  </label>
      <input type="text" name="username" id="username" required autocomplete="off" placeholder="Masukan Username Anda">
      <br><br>
      <label for="password">Masukan Password :  </label>
      <input type="password" name="password" id="password" required autocomplete="off" placeholder="Masukan Password Anda">
      <br><br>
      <label for="password2">Konfirmasi Password :  </label>
      <input type="password" name="password2" id="password2" required autocomplete="off" placeholder="Konfirmasi Password Anda">
      <br><br>
      <button type="submit" name="submit">Sign Up</button>
    </form>
    <br><br>
    <a href="login.php">Sudah Punya Akun?</a>
  </body>
</html>
