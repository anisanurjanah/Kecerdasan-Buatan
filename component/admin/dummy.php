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
  <title>Admin - Dummy</title>

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
        <li class="active">Dummy</li>
      </ol>
    </div><!--/.row-->

    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dummy</h1>
      </div>
    </div><!--/.row-->

    <div class="row">
      <div class=" col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="tambah-gejala.php" class="btn btn-primary mb-4">Tambah Data</a>
          </div>
          <div class="panel-body">
            <table id="ssptable3" class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Aksi</th>
                  <th class="text-center" scope="col">ID</th>
                  <th class="text-center" scope="col">Nama</th>
                </tr>
              </thead>
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
    // $(document).ready( function () {
    //     $('#ssptable3').DataTable();
    // } );

    $(function() {
      $('#ssptable3').DataTable({
          "aLengthMenu":[[10,25,50,100,250,500,1000,5000],[10,25,50,100,250,500,1000,5000]],
          "responsive" : false,
          "processing": true,
          "serverSide": true,
          "searching":true,
          "bFilter":false,
          "bFalse":false,
          "bSort":true,
          "order": [[0, 'asc']], // Set default column index (5) and direction (desc)
          "ajax":{
            "url": "dummy2.php",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {}
          },
          "columns": [
            { "data": "No" },
            { "data": "Aksi" },
            { "data": "ID" },
            { "data": "Nama" },
          ]
      });
  });
  </script>

</body>

</html>