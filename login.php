<?php
session_start();

require 'function.php';

if (isset($_SESSION["login"])) {
  header("location: index.php");
  exit;
}

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if (mysqli_num_rows($query) === 1) {

    $rows = mysqli_fetch_assoc($query);

    if (password_verify($password, $rows["password"])) {

      $_SESSION["login"] = true;

      header("location: index.php");
    }
  }
  $error = true;
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/registrasi.css">
  </head>
  <body>
    <h1>Sign In</h1><hr>
    <?php if(isset($error)): ?>
      <script type="text/javascript">alert('Username Dan Password Salah')</script>
    <?php endif; ?>
    <form class="" action="" method="post">
      <label for="username">Masukan Username :  </label>
      <input type="text" name="username" id="username" required autocomplete="off" placeholder="Masukan Username Anda">
      <br><br>
      <label for="password">Masukan Password :  </label>
      <input type="password" name="password" id="password" required autocomplete="off" placeholder="Masukan Password Anda">
      <br><br>
      <button type="submit" name="submit">Sign In</button>
    </form>
    <br><br>
    <a href="registrasi.php">Belum Mempunyai Akun?</a>
  </body>
</html>
