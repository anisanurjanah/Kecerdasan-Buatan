<?php
session_start();
require '../functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../login/login.php");
  exit;
}

if ($_SESSION['login'] === true) {
  if ($_SESSION['level'] == 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
  } else if ($_SESSION['level'] != 'user') {
    header("Location: ../not-found.php");
    exit;
  }
}

$kd_pengguna = $_GET['kd_pengguna'];

tambahLaporan($_GET);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Konsultasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/user/img/favicon.png" rel="icon">
  <link href="../../assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/user/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'template/navbar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php include 'template/sidebar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Konsultasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Konsultasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="card">
        <div class="card-body">

          <?php

          $kd_penyakit = $_GET['kd_penyakit'];

          $result = mysqli_query($conn, "SELECT * FROM penyakit WHERE kd_penyakit = '$kd_penyakit'");
          $row = mysqli_fetch_assoc($result);

          ?>

          <div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
            <h2 class="alert-heading text-center">DIAGNOSA</h2>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="alert alert-info  alert-dismissible fade show" role="alert">
                <h5 class="alert-heading text-center">Kode Penyakit</h5>
                <hr>
                <h1 class="text-center"><?= $row["kd_penyakit"]; ?></h1>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="alert alert-info  alert-dismissible fade show" role="alert">
                <h5 class="alert-heading text-center">Nama Penyakit</h5>
                <hr>
                <h1 class="text-center"><?= $row["nama_penyakit"]; ?></h1>
              </div>
            </div>
          </div>

          <a href="konsultasi.php?kd_pengguna=<?= $kd_pengguna; ?>" class="btn btn-primary">Kembali</a>

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'template/footer.php'; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/user/js/main.js"></script>

</body>

</html>