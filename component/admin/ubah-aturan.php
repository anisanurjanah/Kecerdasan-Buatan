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


if (isset($_POST["submit"])) {
  if (ubahAturan($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil diubah!');
        document.location.href ='data-aturan.php';
      </script>
    ";
  } else {
    echo "
    <script>
        alert('Data gagal diubah!');
        document.location.href ='data-aturan.php';
    </script>
    ";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Ubah Data Aturan</title>

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
        <li>Data Aturan</li>
        <li class="active">Ubah Data Aturan</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Ubah Data Aturan</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="data-aturan.php"><svg class="glyph stroked arrow left">
                <use xlink:href="#stroked-arrow-left"></use>
              </svg>
            </a>
            <a href="data-aturan.php" class="btn btn-info">Kembali</a>
          </div>

          <div class="panel-body">
            <form action="" method="post" role="form">
              <?php

              $kd_aturan = $_GET["kd_aturan"];

              $aturan = query("SELECT * FROM aturan WHERE kd_aturan = '$kd_aturan'")[0];

              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="kd_aturan" id="kd_aturan" autocomplete="off" value="<?= $aturan["kd_aturan"]; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kd_penyakit">Kode Penyakit</label>
                    <select class="form-control" name="kd_penyakit" id="kd_penyakit">
                      <?php
                      $penyakit = query("SELECT * FROM penyakit");
                      foreach ($penyakit as $row) {
                        echo "<option value=\"" . $row["kd_penyakit"] . "\"" . isSelected($row["kd_penyakit"], $aturan["kd_penyakit"]) . ">" . $row["kd_penyakit"] . " | " . $row["nama_penyakit"] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kd_gejala">Kode Gejala</label>
                    <select class="form-control" name="kd_gejala" id="kd_gejala">
                      <?php
                      $gejala = query("SELECT * FROM gejala");
                      foreach ($gejala as $row) {
                        echo "<option value=\"" . $row["kd_gejala"] . "\"" . isSelected($row["kd_gejala"], $aturan["kd_gejala"]) . ">" . $row["kd_gejala"] . " | " . $row["nama_gejala"] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>

        </div>
      </div>
    </div><!--/.row-->

  </div> <!--/.main-->

  <script src="../../assets/admin/js/jquery-1.11.1.min.js"></script>
  <script src="../../assets/admin/js/bootstrap.min.js"></script>

</body>

</html>