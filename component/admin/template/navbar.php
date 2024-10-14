<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <span>SKIN</span>HEALTHY</a>
      <ul class="user-menu">

        <?php
        if (isset($_COOKIE['kd_pengguna'])) :
          $kd_pengguna = $_COOKIE['kd_pengguna'];

          //ambil nama
          $result = mysqli_query($conn, "SELECT nama FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
          $row = mysqli_fetch_assoc($result);
        ?>

          <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                <use xlink:href="#stroked-male-user"></use>
              </svg><?= $row["nama"]; ?><span class="caret"></span></a>

          <?php endif; ?>

          <ul class="dropdown-menu" role="menu">
            <li><a href="../login/logout.php"><svg class="glyph stroked cancel">
                  <use xlink:href="#stroked-cancel"></use>
                </svg> Logout</a></li>
          </ul>
          </li>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>