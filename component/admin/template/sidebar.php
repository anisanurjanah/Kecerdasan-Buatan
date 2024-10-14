<?php
// Mendapatkan halaman yang sedang aktif
$current_page = basename($_SERVER['PHP_SELF']);

// Daftar menu
$menus = array(
  array(
    'label' => 'Dashboard',
    'icon' => 'stroked-dashboard-dial',
    'link' => 'dashboard.php',
    'dropdown' => false
  ),
  array(
    'label' => 'Data',
    'icon' => 'stroked-chevron-down',
    'link' => '#',
    'dropdown' => true,
    'submenus' => array(
      array(
        'label' => 'Penyakit',
        'icon' => 'stroked-open-folder',
        'link' => 'data-penyakit.php'
      ),
      array(
        'label' => 'Gejala',
        'icon' => 'stroked-open-folder',
        'link' => 'data-gejala.php'
      ),
      array(
        'label' => 'Aturan',
        'icon' => 'stroked-open-folder',
        'link' => 'data-aturan.php'
      )
    )
  ),
  array(
    'label' => 'Laporan',
    'icon' => 'stroked-open-folder',
    'link' => 'laporan-hasil-diagnosa.php',
    'dropdown' => false
  ),
  array(
    'label' => 'Data Pengguna',
    'icon' => 'stroked-male-user',
    'link' => 'data-pengguna.php',
    'dropdown' => false
  )
);


?>

<!-- Menampilkan menu -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
  <ul class="nav menu">
    <li role="presentation" class="divider"></li>
    <?php foreach ($menus as $menu) { ?>
      <?php if ($menu['dropdown']) { ?>
        <li class="parent">
          <a href="">
            <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph <?php echo $menu['icon']; ?>">
                <use xlink:href="#<?php echo $menu['icon']; ?>"></use>
              </svg></span>
            <?php echo $menu['label']; ?>
          </a>
          <ul class="children collapse" id="sub-item-1">
            <?php foreach ($menu['submenus'] as $submenu) { ?>
              <li>
                <a href=" <?php echo $submenu['link']; ?>">
                  <svg class="glyph <?php echo $submenu['icon']; ?>">
                    <use xlink:href="#<?php echo $submenu['icon']; ?>"></use>
                  </svg>
                  <?php echo $submenu['label']; ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } else { ?>
        <li class="<?php echo isActiveAdmin($menu['link'], $current_page); ?>">
          <a href="<?php echo $menu['link']; ?>">
            <svg class="glyph <?php echo $menu['icon']; ?>">
              <use xlink:href="#<?php echo $menu['icon']; ?>"></use>
            </svg>
            <?php echo $menu['label']; ?>
          </a>
        </li>
      <?php } ?>
    <?php } ?>
    <li role="presentation" class="divider"></li>
  </ul>
</div>