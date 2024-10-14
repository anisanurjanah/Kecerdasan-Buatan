<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="../../assets/user/img/logo.png" alt="logo">
      <span class="d-none d-lg-block">SKINHEALTHY</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">
        <?php

        if (isset($_COOKIE['kd_pengguna'])) {
          $kd_pengguna = $_COOKIE['kd_pengguna'];

          //ambil nama
          $result = mysqli_query($conn, "SELECT nama FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
          $row = mysqli_fetch_assoc($result);

          echo "<a class=\"nav-link nav-profile d-flex align-items-center pe-0\" href=\"#\" data-bs-toggle=\"dropdown\">
                      <i class=\"bi bi-person-fill rounded-circle\"></i>
                      <span class=\"d-none d-md-block dropdown-toggle ps-2\">" . $row["nama"] . "</span>
                    </a>";
        } else {
          echo "<a class=\"nav-link nav-profile d-flex align-items-center pe-0\" href=\"../login/login.php\">
                      <i class=\"bi bi-power\"></i>
                      <span class=\"d-none d-md-block ps-2\">Sign In</span>
                    </a>";
        }

        ?>
        <!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <?php
          if (isset($_COOKIE['kd_pengguna'])) :
            $kd_pengguna = $_COOKIE['kd_pengguna'];

            //ambil nama
            $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
            $row = mysqli_fetch_assoc($result);
          ?>

            <li class="dropdown-header">
              <h6><?= $row["nama"]; ?></h6>
              <span><?= $row["username"]; ?></span>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="data-user.php?kd_pengguna=<?= $row["kd_pengguna"]; ?>">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>

          <?php endif; ?>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../login/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Keluar</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->