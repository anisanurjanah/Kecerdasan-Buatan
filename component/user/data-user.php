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

$result = mysqli_query($conn, "SELECT * FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {

  if (isset($_POST["jenis_kelamin"])) {
    $selected_option = $_POST['jenis_kelamin'];
  }

  if (ubahPengguna($_POST) > 0) {
    $editSuccessfully = true;
  } else {
    $editFailed = true;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Profil</title>
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
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../../index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profil</button>
                </li>

              </ul>

              <div class="tab-content pt-2">

                <?php

                if (isset($_SESSION['errorMessage'])) {
                  $errorMessage = $_SESSION['errorMessage'];

                  echo "
                        <div class=\"alert alert-danger fade show\" role=\"alert\">
                          <i class=\"bi bi-exclamation-octagon me-1\"></i>" . htmlspecialchars($errorMessage) . "
                        </div>
                    ";
                  unset($_SESSION['errorMessage']);
                } else if (isset($editSuccessfully)) {
                  echo "
                        <div class=\"alert alert-success fade show\" role=\"alert\">
                          <i class=\"bi bi-check-circle me-1\"></i>
                          Data berhasil diubah!
                        </div>
                      ";
                } else if (isset($editFailed)) {
                  echo "
                          <div class=\"alert alert-danger fade show\" role=\"alert\">
                            <i class=\"bi bi-exclamation-octagon me-1\"></i>
                            Data gagal diubah!
                          </div>
                        ";
                }

                ?>

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Detail Profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Kode Pengguna</div>
                    <div class="col-lg-9 col-md-8"><?= $row["kd_pengguna"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama</div>
                    <div class="col-lg-9 col-md-8"><?= $row["nama"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8"><?= $row["username"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tempat Lahir</div>
                    <div class="col-lg-9 col-md-8"><?= $row["tempat_lahir"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8"><?= date('j F Y', strtotime($row["tanggal_lahir"])); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8"><?= $row["alamat"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8"><?= $row["jenis_kelamin"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">No. Telepon</div>
                    <div class="col-lg-9 col-md-8"><?= $row["no_telepon"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $row["email"]; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Bergabung Sejak</div>
                    <div class="col-lg-9 col-md-8"><?= $row["bergabung_sejak"]; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="" method="post">

                    <div class="row mb-3">
                      <div class="col-md-8 col-lg-9">
                        <input name="kd_pengguna" type="hidden" class="form-control" id="kd_pengguna" value="<?= $row["kd_pengguna"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-8 col-lg-9">
                        <input name="usernameLama" type="hidden" class="form-control" id="usernameLama" value="<?= $row["username"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-8 col-lg-9">
                        <input name="emailLama" type="hidden" class="form-control" id="emailLama" value="<?= $row["email"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" type="text" class="form-control" id="nama" value="<?= $row["nama"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username" value="<?= $row["username"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tempat_lahir" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" value="<?= $row["tempat_lahir"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="tanggal_lahir" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" value="<?= $row["tanggal_lahir"]; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="alamat" type="text" class="form-control" id="alamat" value="<?= $row["alamat"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <fieldset class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input name="jenis_kelamin" type="radio" class="form-check-input" id="laki-laki" value="Laki-Laki" <?php echo isChecked('Laki-Laki', $row["jenis_kelamin"]); ?>>
                          <label class="form-check-label" for="laki-laki">
                            Laki-Laki
                          </label>
                        </div>

                        <div class="form-check">
                          <input name="jenis_kelamin" type="radio" class="form-check-input" id="perempuan" value="Perempuan" <?php echo isChecked('Perempuan', $row["jenis_kelamin"]); ?>>
                          <label class="form-check-label" for="perempuan">
                            Perempuan
                          </label>
                        </div>
                      </div>
                    </fieldset>

                    <div class="row mb-3">
                      <label for="no_telepon" class="col-md-4 col-lg-3 col-form-label">No. Telepon</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="no_telepon" type="text" class="form-control" id="no_telepon" value="<?= $row["no_telepon"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email" value="<?= $row["email"]; ?>" autocomplete="off">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>

                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
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

</body>

</html>