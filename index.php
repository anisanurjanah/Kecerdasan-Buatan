<?php
session_start();
require 'component/functions.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Beranda</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/user/img/favicon.png" rel="icon">
  <link href="assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/user/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/user/img/logo.png" alt="logo">
        <span class="d-none d-lg-block">SKINHEALTHY</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <?php

          if (isset($_COOKIE['kd_pengguna'])) {
            $kd_pengguna = $_COOKIE['kd_pengguna'];

            //ambil nama
            $result = mysqli_query($conn, "SELECT nama FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
            $row = mysqli_fetch_assoc($result);

            echo "<a class=\"nav-link nav-profile d-flex align-items-center pe-0\" href=\"#\" data-bs-toggle=\"dropdown\">
                    <i class=\"bi bi-person-fill rounded-circle\"></i>
                    <span class=\"d-none d-md-block dropdown-toggle ps-2\">" . $row["nama"] . "</span>
                  </a>";
          } else {
            echo "<a class=\"nav-link nav-profile d-flex align-items-center pe-0\" href=\"component/login/login.php\">
                    <i class=\"bi bi-power\"></i>
                    <span class=\"d-none d-md-block ps-2\">Sign In</span>
                  </a>";
          }

          ?><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <?php
            if (isset($_COOKIE['kd_pengguna'])) :
              $kd_pengguna = $_COOKIE['kd_pengguna'];

              //ambil nama
              $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
              $row = mysqli_fetch_assoc($result);
            ?>
              <li class="dropdown-header">
                <h6><?= $row["nama"]; ?></h6>
                <span><?= $row["username"]; ?></span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="component/user/data-user.php?kd_pengguna=<?= $row["kd_pengguna"]; ?>">
                  <i class="bi bi-person"></i>
                  <span>Profil</span>
                </a>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="component/login/logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Keluar</span>
                </a>
              </li>

            <?php endif; ?>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Beranda</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-text"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="component/user/informasi-penyakit.php">
              <i class="bi bi-file-text"></i><span>Penyakit Kulit</span>
            </a>
          </li>
          <li>
            <a href="component/user/informasi-artikel.php">
              <i class="bi bi-file-text"></i><span>Artikel</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <?php
      if (isset($_COOKIE['kd_pengguna'])) :
        $kd_pengguna = $_COOKIE['kd_pengguna'];

        //ambil nama
        $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
        $row = mysqli_fetch_assoc($result);
      ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="component/user/konsultasi.php?kd_pengguna=<?= $row["kd_pengguna"]; ?>">
            <i class="bi bi-file-medical"></i>
            <span>Konsultasi</span>
          </a>
        </li><!-- End Konsultasi Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="component/user/riwayat.php?kd_pengguna=<?= $row["kd_pengguna"]; ?>">
            <i class="bi bi-file-medical"></i>
            <span>Riwayat Konsultasi</span>
          </a>
        </li><!-- End Riwayat Konsultasi Nav -->

      <?php else : ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="component/user/konsultasi.php">
            <i class="bi bi-file-medical"></i>
            <span>Konsultasi</span>
          </a>
        </li><!-- End Konsultasi Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="component/user/riwayat.php">
            <i class="bi bi-file-medical"></i>
            <span>Riwayat Konsultasi</span>
          </a>
        </li><!-- End Riwayat Konsultasi Nav -->

      <?php endif; ?>

    </ul>



  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Beranda</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-fill"></i></a></li>
          <li class="breadcrumb-item active">Beranda</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class=" col-lg-12">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title"></h5>

              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/user/img/carousel-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>SKINHEALTHY EXPERT SYSTEM</h5>
                      <p>Find your skin diseases here for better prevention.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/user/img/carousel-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>SKINHEALTHY EXPERT SYSTEM</h5>
                      <p>Find your skin diseases here for better prevention.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="assets/user/img/artikel-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>SKINHEALTHY EXPERT SYSTEM</h5>
                      <p>Find your skin diseases here for better prevention.</p>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with captions -->
            </div>
          </div>

        </div>
      </div>

    </section>

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SKINAPPS</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/user/js/main.js"></script>

</body>

</html>