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
  <title>Admin - Data Aturan</title>

  <!-- Favicons -->
  <link href="../../assets/user/img/favicon.png" rel="icon">
  <link href="../../assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="../../assets/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/admin/css/styles.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  

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
        <li class="active">Data Aturan</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Aturan</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="tambah-aturan.php" class="btn btn-primary mb-4">Tambah Data</a>
          </div>
          <div class="panel-body">
            <table id="tb_aturan" class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Aksi</th>
                  <th class="text-center" scope="col">Kode Aturan</th>
                  <th class="text-center" scope="col">Kode Penyakit</th>
                  <th class="text-center" scope="col">Nama Penyakit</th>
                  <th class="text-center" scope="col">Kode Gejala</th>
                  <th class="text-center" scope="col">Nama Gejala</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $aturan = query("SELECT aturan.kd_aturan,
                                          penyakit.kd_penyakit,
                                          penyakit.nama_penyakit,
                                          gejala.kd_gejala,
                                          gejala.nama_gejala
                                  FROM ((aturan INNER JOIN penyakit ON aturan.kd_penyakit = penyakit.kd_penyakit)
                                  INNER JOIN gejala ON aturan.kd_gejala = gejala.kd_gejala)");

                  foreach ($aturan as $data_aturan) {
                    echo "
                      <tr>
                        <th class=\"col-md-.5 text-center\" scope=\"row\">" . $i . "</th>
                        <td class=\"col-md-1.5 text-center\">
                          <a href=\"ubah-aturan.php?kd_aturan=" . $data_aturan['kd_aturan'] . "\" class=\"btn btn-success btn-sm\">Ubah</a> |
                          <a href=\"hapus-aturan.php?kd_aturan=" . $data_aturan['kd_aturan'] . "\" class=\"btn btn-danger btn-sm\">Hapus</a>
                        </td>
                        <td class=\"col-md-1.5 text-center\">" . $data_aturan["kd_aturan"] . "</td>
                        <td class=\"col-md-1.5 text-center\">" . $data_aturan["kd_penyakit"] . "</td>
                        <td class=\"col-md-1.5 text-center\">" . $data_aturan["nama_penyakit"] . "</td>
                        <td class=\"col-md-1.5 text-center\">" . $data_aturan["kd_gejala"] . "</td>
                        <td class=\"col-md-4\">" . $data_aturan["nama_gejala"] . "</td>
                      </tr>
                      ";
                    $i++;
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><!--/.row-->

  </div> <!--/.main-->

  <script src="../../assets/admin/js/jquery-1.11.1.min.js"></script>
  <script src="../../assets/admin/js/bootstrap.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready( function () {
        $('#tb_aturan').DataTable();
    } );
  </script>

</body>

</html>