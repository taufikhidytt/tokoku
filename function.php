<?php
$conn = mysqli_connect('localhost', 'root', '', 'tokoku');

function liatdata($liat){
  global $conn;
  $query = mysqli_query($conn, $liat);
  $rows = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambahdata($tambah){
  global $conn;
  $km = htmlspecialchars($tambah["kodemenu"]);
  $nm = htmlspecialchars($tambah["namamenu"]);
  $hm = htmlspecialchars($tambah["hargamenu"]);
  $pd = htmlspecialchars($tambah["photodefult"]);

  $pm = upload();
  if (!$pm) {
    $pm = $pd;
  }

  mysqli_query($conn, "INSERT INTO menu_toko
                                VALUES
                      ('', '$km', '$nm', '$hm', '$pm');
  ");

  return mysqli_affected_rows($conn);

}

function upload(){
  global $conn;
  $namaFile = $_FILES["photomenu"]["name"];
  $ukuranFile = $_FILES["photomenu"]["size"];
  $error = $_FILES["photomenu"]["error"];
  $tmpName = $_FILES["photomenu"]["tmp_name"];

  if ($error === 4) {
    ?><script type="text/javascript">alert('Anda Belum Memasukan Photo, Photo Default Di Memasukan')</script> <?php
    return false;
  }

  $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    ?><script type="text/javascript">alert('Ekstensi Gambar Tidak Sesuai Format jpg, png, jpeg. Photo Default Di Memasukan')</script> <?php
    return false;
  }

  if ($ukuranFile > 3000000) {
    ?><script type="text/javascript">alert('Ukuran File Terlalu Besar, Photo Default Di Memasukan')</script> <?php
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

  return $namaFileBaru;
}

function hapusdata($hapus){
  global $conn;
  mysqli_query($conn, "DELETE FROM menu_toko WHERE id = $hapus");
  return mysqli_affected_rows($conn);
}

function ubahdata($ubah){
  global $conn;
  $id = $ubah["id"];
  $km = htmlspecialchars($ubah["kodemenu"]);
  $nm = htmlspecialchars($ubah["namamenu"]);
  $hm = htmlspecialchars($ubah["hargamenu"]);
  $pl = htmlspecialchars($ubah["photolama"]);

  if ($_FILES["photomenu"]["error"]) {
    $pm = $pl;
  }else {
    $pm = upload();
  }

  mysqli_query($conn, "UPDATE menu_toko SET
                        kode_menu = '$km',
                        nama_menu = '$nm',
                        harga_menu = '$hm',
                        photo_menu = '$pm'
                        WHERE id = $id
  ");

  return mysqli_affected_rows($conn);

}

function caridata($cari){
  global $conn;
  $query = "SELECT * FROM menu_toko
                  WHERE
            kode_menu LIKE '%$cari%' OR
            nama_menu LIKE '%$cari%' OR
            harga_menu LIKE '%$cari%'
  ";
  mysqli_query($conn, $query);
  return liatdata($query);
}

function registrasi($regist){
  global $conn;
  $username = strtolower(stripslashes($regist["username"]));
  $password = mysqli_real_escape_string($conn, $regist["password"]);
  $password2 = mysqli_real_escape_string($conn, $regist["password2"]);

  $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if (mysqli_fetch_assoc($query)) {
    ?><script type="text/javascript">alert('Username Sudah Terpakai, Silahkan Cari Username Lain')</script> <?php
    return false;
  }

  if ($password !== $password2) {
    ?><script type="text/javascript">alert('Konfirmasi Password Yang Anda Masukan Tidak Sama')</script> <?php
    return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);

  mysqli_query($conn, "INSERT INTO users
                              VALUES
                      ('', '$username', '$password')
  ");
  return mysqli_affected_rows($conn);
}


 ?>
