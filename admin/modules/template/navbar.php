<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse border-0">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' ? 'active' : ''?>" href="<?= base_url()?>dashboard.php">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <?php if(@$_SESSION['level'] == 'Super Admin' || @$_SESSION['level'] == 'Pimpinan'):?>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'pegawai.php' ? 'active' : ''?>" href="<?= base_url()?>pegawai.php">
            <span data-feather="file"></span>
            Pegawai
          </a>
        </li>
      <?php endif?>
      <?php if(@$_SESSION['level'] == 'Super Admin'):?>

        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'pengguna.php' ? 'active' : ''?>" href="<?= base_url()?>pengguna.php">
            <span data-feather="file"></span>
            Pengguna
          </a>
        </li>
      <?php endif?>
      <?php if(@$_SESSION['level'] == 'Super Admin' || @$_SESSION['level'] == 'Admin'):?>

      <li class="nav-item">
        <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'konsultasi.php' ? 'active' : ''?>" href="<?= base_url()?>konsultasi.php">
          <span data-feather="file"></span>
          Konsultasi
        </a>
      </li>
      <?php endif?>
      <?php if(@$_SESSION['level'] == 'Super Admin' || @$_SESSION['level'] == 'Admin'):?>

      <li class="nav-item">
        <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'pengunjung.php' ? 'active' : ''?>" href="<?= base_url()?>pengunjung.php">
          <span data-feather="file"></span>
          Pengunjung
        </a>
      </li>
      <?php endif?>
      <?php if(@$_SESSION['level'] == 'Super Admin' || @$_SESSION['level'] == 'Pimpinan'):?>

      <li class="nav-item">
        <a class="nav-link <?= basename($_SERVER['SCRIPT_NAME']) == 'laporan.php' ? 'active' : ''?>" href="<?= base_url()?>laporan.php">
          <span data-feather="shopping-cart"></span>
          Laporan
        </a>
      </li>
      <?php endif?>
      
    </ul>

    
  </div>
</nav>