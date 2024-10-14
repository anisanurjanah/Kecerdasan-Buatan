<?php
session_start();
require '../functions.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Informasi Penyakit</title>
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
      <h1>Informasi Penyakit Kulit</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../index.php">Beranda</a></li>
          <li class="breadcrumb-item"><a href="#">Informasi</a></li>
          <li class="breadcrumb-item active">Penyakit Kulit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Daftar Gejala dan Penyakit Kulit</h5>

            <!-- Bordered Tabs Justified -->
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="penyakit-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-penyakit" type="button" role="tab" aria-controls="penyakit" aria-selected="true">Daftar Penyakit</button>
              </li>
              <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="gejala-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-gejala" type="button" role="tab" aria-controls="gejala" aria-selected="false">Daftar Gejala</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabJustifiedContent">
              <div class="tab-pane fade show active" id="bordered-justified-penyakit" role="tabpanel" aria-labelledby="penyakit-tab">
                <div class="card">
                  <div class="card-body">

                    <!-- Default Table -->
                    <table id="tb_info_penyakit" class="table mt-4">
                      <thead class="table-primary">
                        <tr class="text-center">
                          <th scope="col">No</th>
                          <th scope="col">Kode Penyakit</th>
                          <th scope="col">Nama Penyakit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i = 1;
                          $penyakit = query("SELECT * FROM penyakit");

                          foreach ($penyakit as $data_penyakit) {
                            echo "
                                <tr class=\"text-center\">
                                  <th class=\"col-md-2 text-center\" scope=\"row\">" . $i . "</th>
                                  <td class=\"col-md-5\">" . $data_penyakit["kd_penyakit"] . "</td>
                                  <td class=\"col-md-5\">" . $data_penyakit["nama_penyakit"] . "</td>
                                </tr>
                                ";
                            $i++;
                          }
                        ?>
                      </tbody>
                    </table>
                    <!-- End Default Table Example -->
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="bordered-justified-gejala" role="tabpanel" aria-labelledby="gejala-tab">
                <div class="card">
                  <div class="card-body">

                    <!-- Default Table -->
                    <table id="tb_info_gejala" class="table mt-4">
                      <thead class="table-primary">
                        <tr class="text-center">
                          <th scope="col">No</th>
                          <th scope="col">Kode Gejala</th>
                          <th scope="col">Nama Gejala</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $i = 1;
                          $gejala = query("SELECT * FROM gejala");

                          foreach ($gejala as $data_gejala) {
                            echo "
                                <tr>
                                  <th class=\"col-md-2 text-center\" scope=\"row\">" . $i . "</th>
                                  <td class=\"col-md-5 text-center\">" . $data_gejala["kd_gejala"] . "</td>
                                  <td class=\"col-md-5\">" . $data_gejala["nama_gejala"] . "</td>
                                </tr>
                                ";
                            $i++;
                          }
                        ?>
                      </tbody>
                    </table>
                    <!-- End Default Table Example -->
                  </div>
                </div>
              </div>
            </div><!-- End Bordered Tabs Justified -->

          </div>
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
        $('#tb_info_penyakit').DataTable();
        $('#tb_info_gejala').DataTable();
    } );
  </script>

</body>

</html>