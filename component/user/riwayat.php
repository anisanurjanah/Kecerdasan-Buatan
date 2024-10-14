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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Riwayat Konsultasi</title>
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  

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
      <h1>Riwayat Konsultasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Riwayat Konsultasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-4">Daftar Riwayat Konsultasi</h5>

          <!-- Default Table -->
          <table id="tb_riwayat" class="table mt-4">
            <thead class="table-primary">
              <tr class="text-center">
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode Laporan</th>
                <th class="text-center" scope="col">Hari/Tanggal</th>
                <th class="text-center" scope="col">Waktu</th>
                <th class="text-center" scope="col">Nama Pengguna</th>
                <th class="text-center" scope="col">Kode Diagnosa</th>
                <th class="text-center" scope="col">Kode Penyakit</th>
              </tr>
            </thead>
            
            <tbody>
              <?php
                $kd_pengguna = $_GET['kd_pengguna'];

                $i = 1;
                $laporan = query("SELECT laporan_hasil_diagnosa.kd_laporan,
                                  pengguna.kd_pengguna,
                                  pengguna.nama,
                                  diagnosa.kd_diagnosa,
                                  aturan.kd_penyakit,
                                  laporan_hasil_diagnosa.tanggal,
                                  laporan_hasil_diagnosa.hari,
                                  laporan_hasil_diagnosa.waktu
                          FROM (((laporan_hasil_diagnosa
                          INNER JOIN pengguna ON laporan_hasil_diagnosa.kd_pengguna = pengguna.kd_pengguna)
                          INNER JOIN diagnosa ON laporan_hasil_diagnosa.kd_diagnosa = diagnosa.kd_diagnosa)
                          INNER JOIN aturan ON laporan_hasil_diagnosa.kd_penyakit = aturan.kd_penyakit)
                          WHERE pengguna.kd_pengguna = '$kd_pengguna'
                          ");

                if ($laporan) {
                  foreach ($laporan as $data_laporan) {
                    echo "
                      <tr>
                        <th class=\"col-md-.5 text-center\" scope=\"row\">" . $i . "</th>
                        <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_laporan"] . "</td>
                        <td class=\"col-md-3 text-center\">" . $data_laporan["hari"] . ", " . date('j F Y', strtotime($data_laporan["tanggal"])) . "</td>
                        <td class=\"col-md-1 text-center\">" . $data_laporan["waktu"] . "</td>
                        <td class=\"col-md-3 text-center\">" . $data_laporan["nama"] . "</td>
                        <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_diagnosa"] . "</td>
                        <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_penyakit"] . "</td>
                      </tr>
                      ";
                      $i++;
                    }
                  } else {
                  echo "
                      <p class=\"text-center\">Riwayat belum tersedia.</p>
                      ";
                }

              ?>
            </tbody>
          </table>
          <!-- End Default Table Example -->

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
  <script src="../../assets/admin/js/jquery-1.11.1.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready( function () {
        $('#tb_riwayat').DataTable();
    } );
  </script>

</body>

</html>