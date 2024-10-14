<?php
session_start();
require '../functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../login/login.php");
  exit;
}

if ($_SESSION['login'] === true) {
  if ($_SESSION['level'] != 'admin') {
    header("Location: ../not-found.php");
    exit;
  }
}

$kd_gejala = $_GET["kd_gejala"];

if (hapusGejala($kd_gejala) > 0) {
  echo "
      <script>
        alert('Data berhasil dihapus!');
        document.location.href ='data-gejala.php';
      </script>
    ";
} else {
  echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href ='data-gejala.php';
    </script>
    ";
}
