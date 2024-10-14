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
  <title>Admin - Dashboard</title>

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
        <li><a href="#"><svg class="glyph stroked home">
              <use xlink:href="#stroked-home"></use>
            </svg></a></li>
        <li class="active">Dashboard</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-blue panel-widget ">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked folder">
                <use xlink:href="#stroked-folder"></use>
              </svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <?php
              $penyakit = query("SELECT COUNT(*) as total FROM penyakit");

              foreach ($penyakit as $row) {
                echo "<div class=\"large\">" . $row["total"] . "</div>";
              }

              ?>
              <div class="text-muted">Daftar Penyakit</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-orange panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked folder">
                <use xlink:href="#stroked-folder"></use>
              </svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <?php
              $gejala = query("SELECT COUNT(*) as total FROM gejala");

              foreach ($gejala as $row) {
                echo "<div class=\"large\">" . $row["total"] . "</div>";
              }

              ?>
              <div class="text-muted">Daftar Gejala</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-teal panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked folder">
                <use xlink:href="#stroked-folder"></use>
              </svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <?php
              $aturan = query("SELECT COUNT(*) as total FROM aturan");

              foreach ($aturan as $row) {
                echo "<div class=\"large\">" . $row["total"] . "</div>";
              }

              ?>
              <div class="text-muted">Daftar Aturan</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-red panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked folder">
                <use xlink:href="#stroked-folder"></use>
              </svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <?php
              $laporan = query("SELECT COUNT(*) as total FROM laporan_hasil_diagnosa");

              foreach ($laporan as $row) {
                echo "<div class=\"large\">" . $row["total"] . "</div>";
              }

              ?>
              <div class="text-muted">Daftar Laporan</div>
            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->

  </div> <!--/.main-->

  <script src="../../assets/admin/js/jquery-1.11.1.min.js"></script>
  <script src="../../assets/admin/js/bootstrap.min.js"></script>

</body>

</html>