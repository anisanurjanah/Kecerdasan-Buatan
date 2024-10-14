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
  <title>Admin - Data Pengguna</title>

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
        <li class="active">Data Pengguna</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Pengguna</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <table id="tb_pengguna" class="table table-bordered">
              <thead>
                <tr>
                  <th class="col-sm-.5 text-center" scope="col">No</th>
                  <th class="col-sm-1.5 text-center" scope="col">Kode Pengguna</th>
                  <th class="col-sm-1 text-center" scope="col">Nama</th>
                  <th class="col-sm-1 text-center" scope="col">Username</th>
                  <th class="col-sm-2 text-center" scope="col">Tempat/Tanggal Lahir</th>
                  <th class="col-sm-2 text-center" scope="col">Alamat</th>
                  <th class="col-sm-1 text-center" scope="col">Jenis Kelamin</th>
                  <th class="col-sm-1 text-center" scope="col">No. Telepon</th>
                  <th class="col-sm-1 text-center" scope="col">Email</th>
                  <th class="col-sm-1 text-center" scope="col">Bergabung Sejak</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $pengguna = query("SELECT * FROM pengguna");

                  foreach ($pengguna as $data_pengguna) {
                    echo "
                      <tr>
                        <th class=\"col-sm-.5 text-center\" scope=\"row\">" . $i . "</th>
                        <td class=\"col-sm-1.5 text-center\">" . $data_pengguna["kd_pengguna"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["nama"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["username"] . "</td>
                        <td class=\"col-sm-2 text-center\">" . $data_pengguna["tempat_lahir"] . ", " . date('j F Y', strtotime($data_pengguna["tanggal_lahir"])) . "</td>
                        <td class=\"col-sm-2 text-center\">" . $data_pengguna["alamat"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["jenis_kelamin"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["no_telepon"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["email"] . "</td>
                        <td class=\"col-sm-1 text-center\">" . $data_pengguna["bergabung_sejak"] . "</td>
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
        $('#tb_pengguna').DataTable();
    } );
  </script>

</body>

</html>