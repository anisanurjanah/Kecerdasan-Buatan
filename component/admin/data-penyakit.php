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
  <title>Admin - Data Penyakit</title>

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
        <li class="active">Data Penyakit</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Data Penyakit</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="tambah-penyakit.php" class="btn btn-primary mb-4">Tambah Data</a>
          </div>
          <div class="panel-body">
            <table id="tb_penyakit" class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Aksi</th>
                  <th class="text-center" scope="col">Kode Penyakit</th>
                  <th class="text-center" scope="col">Nama Penyakit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $penyakit = query("SELECT * FROM penyakit");

                  foreach ($penyakit as $data_penyakit) {
                    echo "
                    <tr>
                      <th class=\"col-md-.5 text-center\" scope=\"row\">" . $i . "</th>
                      <td class=\"col-md-1.5 text-center\">
                        <a href=\"ubah-penyakit.php?kd_penyakit=" . $data_penyakit['kd_penyakit'] . "\" class=\"btn btn-success btn-sm\">Ubah</a> |
                        <a href=\"hapus-penyakit.php?kd_penyakit=" . $data_penyakit['kd_penyakit'] . "\" class=\"btn btn-danger btn-sm\">Hapus</a>
                      </td>
                      <td class=\"col-md-5 text-center\">" . $data_penyakit["kd_penyakit"] . "</td>
                      <td class=\"col-md-5 text-center\">" . $data_penyakit["nama_penyakit"] . "</td>
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
        $('#tb_penyakit').DataTable();
    } );
  //   $(function() {
  //     $('#ssptable1').DataTable({
  //         "aLengthMenu":[[10,25,50,100,250,500,1000,5000],[10,25,50,100,250,500,1000,5000]],
  //         "responsive" : false,
  //         "processing": true,
  //         "serverSide": true,
  //         "searching":true,
  //         "bFilter":false,
  //         "bFalse":false,
  //         "bSort":true,
  //         "order": [[0, 'asc']], // Set default column index (5) and direction (desc)
  //         "ajax":{
  //           "url": "<?//= $base_url; ?>exe/file.php",
  //           "dataType": "json",
  //           "type": "POST",
  //           "data": function(d) {
  //             d.filterkaryawan = "<?//= $filterkaryawan ?>";
  //           }
  //         },
  //         "columns": [
  //           { "data": "No" },
  //           { "data": "Aksi" },
  //           { "data": "Kode Penyakit" },
  //           { "data": "Nama Penyakit" },
  //         ]
  //     });
  // });
  </script>

</body>

</html>