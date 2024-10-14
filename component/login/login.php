<?php
session_start();
require '../functions.php';

//cek cookie
if (isset($_COOKIE['kd_pengguna']) && isset($_COOKIE['username'])) {
  $kd_pengguna = $_COOKIE['kd_pengguna'];
  $username = $_COOKIE['username'];
  $level = $_COOKIE['level'];

  // ambil username berdasakan id
  $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
  $row = mysqli_fetch_assoc($result);

  if ($username === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
    $_SESSION['level'] = $level;

    if ($level == 'admin') {
      header("Location: ../admin/dashboard.php");
      exit;
    } else {
      header("Location: ../../index.php");
      exit;
    }
  }
}

//cek tombol login udah dipencet atau belum 
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $rememberMe = isset($_POST["remember"]);

  $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    //set session
    $_SESSION["login"] = true;
    $_SESSION["level"] = $row['level'];

    if ($row['level'] === 'admin') {
      // Set cookie untuk level admin
      if ($rememberMe) {
        setLoginCookieWithRemember($row['kd_pengguna'], $row['username'], $row['level']);
      } else {
        setLoginCookieWithoutRemember($row['kd_pengguna'], $row['username'], $row['level']);
      }

      // Redirect ke halaman admin
      header("Location: ../admin/dashboard.php");
      exit;
    } else if ($row['level'] === 'user') {
      // Set cookie untuk level user
      if ($rememberMe) {
        setLoginCookieWithRemember($row['kd_pengguna'], $row['username'], $row['level']);
      } else {
        setLoginCookieWithoutRemember($row['kd_pengguna'], $row['username'], $row['level']);
      }

      // Redirect ke halaman user
      header("Location: ../../index.php");
      exit;
    } else {
      // Tampilkan pesan error jika login gagal
      echo "Login gagal. Silakan coba lagi.";
    }
  }

  $error = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Sign In</title>
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="../../assets/user/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SKINHEALTHY</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <?php
                    if (isset($error)) {
                      echo "<div class=\"alert alert-danger fade show\" role=\"alert\">
                              <i class=\"bi bi-exclamation-octagon me-1\"></i>
                              Invalid username or password!
                            </div>";
                    }
                    ?>
                    <a href="../../index.php">
                      <i class="bi bi-arrow-left"></i>
                    </a>
                    <h5 class="card-title text-center pb-0 fs-4">Sign in to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form action="" method="post" class="row g-3 needs-validation">

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="username" autocomplete="off" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Sign In</button>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small mb-0">Don't have account? <a href="registrasi.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/user/js/main.js"></script>

</body>

</html>