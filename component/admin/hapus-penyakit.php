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

$kd_penyakit = $_GET["kd_penyakit"];

if (hapusPenyakit($kd_penyakit) > 0) {
  echo "
      <script>
        alert('Data berhasil dihapus!');
        document.location.href ='data-penyakit.php';
      </script>
    ";
} else {
  echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href ='data-penyakit.php';
    </script>
    ";
}
