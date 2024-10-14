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

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Laporan</title>

  <!-- Favicons -->
  <link href="../../assets/user/img/favicon.png" rel="icon">
  <link href="../../assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/admin/css/styles.css" rel="stylesheet">

  <!--Icons-->
  <script src="../../assets/admin/js/lumino.glyphs.js"></script>

</head>

<body>

  <?php include 'template/navbar.php';  ?>

  <?php include 'template/sidebar.php'; ?>

  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><svg class="glyph stroked home">
              <use xlink:href="#stroked-home"></use>
            </svg></a></li>
        <li class="active">Data Laporan</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Laporan</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Kode Laporan</th>
                  <th class="text-center" scope="col">Hari/Tanggal</th>
                  <th class="text-center" scope="col">Waktu</th>
                  <th class="text-center" scope="col">Nama Pengguna</th>
                  <th class="text-center" scope="col">Kode Diagnosa</th>
                  <th class="text-center" scope="col">Kode Penyakit</th>
                </tr>
              </thead>
              <?php
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
                INNER JOIN aturan ON laporan_hasil_diagnosa.kd_penyakit = aturan.kd_penyakit) ORDER BY laporan_hasil_diagnosa.tanggal");

              foreach ($laporan as $data_laporan) {
                echo "
                <tbody>
                  <tr>
                    <th class=\"col-md-.5 text-center\" scope=\"row\">" . $i . "</th>
                    <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_laporan"] . "</td>
                    <td class=\"col-md-3 text-center\">" . $data_laporan["hari"] . ", " . date('j F Y', strtotime($data_laporan["tanggal"])) . "</td>
                    <td class=\"col-md-1 text-center\">" . $data_laporan["waktu"] . "</td>
                    <td class=\"col-md-3 text-center\">" . $data_laporan["nama"] . "</td>
                    <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_diagnosa"] . "</td>
                    <td class=\"col-md-1.5 text-center\">" . $data_laporan["kd_penyakit"] . "</td>
                  </tr>
                </tbody>
                ";
                $i++;
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div><!--/.row-->

  </div> <!--/.main-->

  <script src="../../assets/admin/js/jquery-1.11.1.min.js"></script>
  <script src="../../assets/admin/js/bootstrap.min.js"></script>

</body>

</html>