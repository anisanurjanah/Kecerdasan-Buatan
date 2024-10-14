<?php
// Mendapatkan halaman yang sedang aktif
$current_page = basename($_SERVER['PHP_SELF']);

// Daftar menu
$menus = array(
  array(
    'label' => 'Informasi',
    'icon' => 'bi bi-file-text',
    'link' => '#',
    'dropdown' => true,
    'submenus' => array(
      array(
        'label' => 'Penyakit Kulit',
        'icon' => 'bi bi-file-text',
        'link' => 'informasi-penyakit.php'
      ),
      array(
        'label' => 'Artikel',
        'icon' => 'bi bi-file-text',
        'link' => 'informasi-artikel.php'
      )
    )
  ),
  array(
    'label' => 'Konsultasi',
    'icon' => 'bi bi-file-medical',
    'link' => 'konsultasi.php',
    'dropdown' => false
  ),
  array(
    'label' => 'Riwayat Konsultasi',
    'icon' => 'bi bi-folder',
    'link' => 'riwayat.php',
    'dropdown' => false
  )
);


?>

<!-- Menampilkan menu -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link collapsed" href="../../index.php">
        <i class="bi bi-grid"></i>
        <span>Beranda</span>
      </a>
    </li>
    <?php foreach ($menus as $menu) { ?>
      <?php if ($menu['dropdown']) { ?>
        <li class="nav-item">
          <a class="nav-link <?php echo isActiveUser($menu['link'], $current_page); ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="<?php echo $menu['link']; ?>">
            <i class="<?php echo $menu['icon']; ?>"></i><span><?php echo $menu['label']; ?></span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            <?php foreach ($menu['submenus'] as $submenu) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $submenu['link']; ?>">
                  <i class="<?php echo $submenu['icon']; ?>"></i>
                  <span><?php echo $submenu['label']; ?></span>
                </a>
              </li><!-- End Dashboard Nav -->
            <?php } ?>
          </ul>
        </li>
      <?php } else { ?>
        <?php
        if (isset($_COOKIE['kd_pengguna'])) {
          $kd_pengguna = $_COOKIE['kd_pengguna'];

          //ambil nama
          $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE kd_pengguna = '$kd_pengguna'");
          $row = mysqli_fetch_assoc($result);

        ?>
          <li class="nav-item">
            <a class="nav-link <?php echo isActiveUser($menu['link'], $current_page); ?>" href="<?php echo $menu['link'] . "?kd_pengguna=" . $row['kd_pengguna']; ?>">
              <i class="<?php echo $menu['icon']; ?>"></i>
              <span><?php echo $menu['label']; ?></span>
            </a>
          </li><!-- End Dashboard Nav -->
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link <?php echo isActiveUser($menu['link'], $current_page); ?>" href="<?php echo $menu['link']; ?>">
              <i class="<?php echo $menu['icon']; ?>"></i>
              <span><?php echo $menu['label']; ?></span>
            </a>
          </li><!-- End Dashboard Nav -->
        <?php } ?>
      <?php } ?>
    <?php } ?>
  </ul>
</aside><!-- End Sidebar-->