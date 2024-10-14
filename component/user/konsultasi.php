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

if (isset($_POST['submit'])) {

  if (!isset($_POST['gejala'])) {
    $errorEmpty = true;
  } else {
    $gejalaUser = $_POST['gejala'];

    $jumlah_dipilih = count($gejalaUser);

    if ($jumlah_dipilih < 3) {
      $errorSelect = true;
    } else {
      for ($x = 0; $x < $jumlah_dipilih; $x++) {
        $sql = "SELECT penyakit.kd_penyakit,
                      penyakit.nama_penyakit
                      FROM penyakit
                      INNER JOIN aturan ON penyakit.kd_penyakit = aturan.kd_penyakit
                      WHERE aturan.kd_gejala IN ('$gejalaUser[$x]')
                      GROUP BY penyakit.kd_penyakit
                      HAVING COUNT(DISTINCT aturan.kd_gejala) = (SELECT COUNT(DISTINCT kd_gejala) FROM aturan WHERE kd_gejala IN ('$gejalaUser[$x]'))";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // masukan data ke tabel diagnosa
        $kd_diagnosa = generateDiagnoseCode();
        $kd_gejala = $gejalaUser[$x];

        $query = "INSERT INTO diagnosa 
              VALUES 
              ('$kd_diagnosa', '$kd_gejala')
            ";
        $result = mysqli_query($conn, $query);


        header("Location: hasil-diagnosa.php?kd_pengguna=" . $kd_pengguna . "&kd_diagnosa=" . $kd_diagnosa . "&kd_penyakit=" . $row["kd_penyakit"]);
        exit;
      }
    }
  }
}


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
          <h5 class="card-title text-center mb-4">Daftar Gejala</h5>
          <form method="post" action="">

            <?php
            if (isset($errorEmpty)) {
              echo "
                <div class=\"alert alert-danger fade show\" role=\"alert\">
                  <i class=\"bi bi-exclamation-octagon me-1\"></i>
                  Pilih minimal 3 gejala!
                </div>
              ";
            } else if (isset($errorSelect)) {
              echo "
                <div class=\"alert alert-danger fade show\" role=\"alert\">
                  <i class=\"bi bi-exclamation-octagon me-1\"></i>
                  Pilih minimal 3 gejala!
                </div>
              ";
            }
            ?>

            <?php
            $gejala = query("SELECT * FROM gejala");

            foreach ($gejala as $row) {
              echo "
              <div class=\"form-check\">
                <input class=\"form-check-input\" type=\"checkbox\" value='" . $row['kd_gejala'] . "' name='gejala[]' id='" . $row['nama_gejala'] . "' />
                <label class=\"form-check-label\" for='" . $row['nama_gejala'] . "'>
                " . $row['kd_gejala'] . " | " . $row['nama_gejala'] . "
                </label>
              </div>
            ";
            }
            ?>

            <button type="submit" name="submit" class="btn btn-primary mt-4">CEK PENYAKIT</button>

          </form>

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