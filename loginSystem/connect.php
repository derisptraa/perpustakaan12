<?php
// FILE LOGIN SYSTEM 
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "perpustakaan12";
$connect = mysqli_connect($host, $username, $password, $database);


/* SIGN UP Member */
function signUp($data)
{
  global $connect;

  $nisn = htmlspecialchars($data["nisn"]);
  $nama = htmlspecialchars(strtolower($data["nama"]));
  $password = mysqli_real_escape_string($connect, $data["password"]);
  $confirmPw = mysqli_real_escape_string($connect, $data["confirmPw"]);
  $jk = htmlspecialchars($data["jenis_kelamin"]);
  $angkatan = htmlspecialchars($data["angkatan"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $noTlp = htmlspecialchars($data["no_tlp"]);
  $tglDaftar = $data["tgl_pendaftaran"];

  // cek nisn sudah ada / belum 
  $nisnResult = mysqli_query($connect, "SELECT nisn FROM member WHERE nisn = $nisn");
  if (mysqli_fetch_assoc($nisnResult)) {
    echo "<script>
    alert('Nisn sudah terdaftar, silahkan gunakan nisn lain!');
    </script>";
    return 0;
  }

  //cek kodeMember sudah ada / belum
  // $kodeMemberResult = mysqli_query($connect, "SELECT  kode_member FROM member WHERE kode_member = '$kodeMember'");
  // if (mysqli_fetch_assoc($kodeMemberResult)) {
  //   echo "<script>
  //   alert('Kode member telah terdaftar, silahkan gunakan kode member lain!');
  //   </script>";
  //   return 0;
  // }

  // Pengecekan kesamaan confirm password dan password
  if ($password !== $confirmPw) {
    echo "<script>
    alert('password / confirm password tidak sesuai');
    </script>";
    return 0;
  }

  $querySignUp = "INSERT INTO member (nisn, nama, password, jenis_kelamin, angkatan, jurusan, no_tlp, tgl_pendaftaran)
  VALUES ('$nisn', '$nama', '$password', '$jk', '$angkatan', '$jurusan', '$noTlp', '$tglDaftar')";
  mysqli_query($connect, $querySignUp);
  return mysqli_affected_rows($connect);
}
