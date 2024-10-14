<?php
require '../functions.php';

if (isset($_POST["submit"])) {
  $nama = $_POST["nama"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $password2 = $_POST["password2"];

  if (!isset($_POST["terms"])) {
    $errorTerms = true;
  } else if (isUsernameAvailable($username)) {
    $errorUsernameAvailable = true;
  } else if (isEmailRegistered($email)) {
    $errorEmailRegistered = true;
  } else if (validatePassword($password)) {
    $errorvalidatePassword = true;
  } else if ($password !== $password2) {
    $errorMatchPassword = true;
  } else if (registrasiUser($_POST) > 0) {
    $createAccountSuccessfully = true;
  } else {
    $createAccountFailed = true;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SKINHEALTHY - Sign Up</title>
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
                    if (isset($errorTerms)) {
                      echo "
                        <div class=\"alert alert-danger fade show\" role=\"alert\">
                          <i class=\"bi bi-exclamation-octagon me-1\"></i>
                          Create account failed! Please agree and accept the terms and conditions.
                        </div>
                      ";
                    } else if (isset($errorUsernameAvailable)) {
                      echo "
                        <div class=\"alert alert-danger fade show\" role=\"alert\">
                          <i class=\"bi bi-exclamation-octagon me-1\"></i>
                          Create account failed! Username already exist.
                        </div>
                      ";
                    } else if (isset($errorEmailRegistered)) {
                      echo "
                          <div class=\"alert alert-danger fade show\" role=\"alert\">
                            <i class=\"bi bi-exclamation-octagon me-1\"></i>
                            Create account failed! Email already registered.
                          </div>
                        ";
                    } else if (isset($errorvalidatePassword)) {
                      echo "
                        <div class=\"alert alert-danger fade show\" role=\"alert\">
                          <i class=\"bi bi-exclamation-octagon me-1\"></i>
                          Create account failed! Password should be at least 6 characters.
                        </div>
                      ";
                    } else if (isset($errorMatchPassword)) {
                      echo "
                        <div class=\"alert alert-danger fade show\" role=\"alert\">
                          <i class=\"bi bi-exclamation-octagon me-1\"></i>
                          Create account failed! Password didn't match.
                        </div>
                      ";
                    } else if (isset($createAccountSuccessfully)) {
                      echo "
                        <div class=\"alert alert-success fade show\" role=\"alert\">
                          <i class=\"bi bi-check-circle me-1\"></i>
                          Create account successfully! Please sign in <a href=\"login.php\">here.</a>
                        </div>
                      ";
                    } else if (isset($createAccountFailed)) {
                      echo "
                      <div class=\"alert alert-danger fade show\" role=\"alert\">
                        <i class=\"bi bi-exclamation-octagon me-1\"></i>
                        Create account failed!
                      </div>
                    ";
                    }
                    ?>

                    <a href="../../index.php">
                      <i class="bi bi-arrow-left"></i>
                    </a>
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form action="" method="post" class="row g-3 needs-validation">
                    <div class="col-12">
                      <input type="hidden" name="bergabung_sejak" class="form-control" id="bergabung_sejak">
                    </div>

                    <div class="col-12">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" required>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" autocomplete="off" required>
                    </div>

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
                      <label for="password2" class="form-label">Confirm Password</label>
                      <input type="password" name="password2" class="form-control" id="password2" autocomplete="off" required>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Create Account</button>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small mb-0">Already have an account? <a href="login.php">Sign In</a></p>
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