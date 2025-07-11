<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User Panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="/dashboard" class="d-block">SIMTAK</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= base_url('dashboard') ?>" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">Layout Options</li>
        <li class="nav-item"><a href="<?= base_url('users/mahasiswa') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Mahasiswa Aktif</p></a></li>
        <li class="nav-item"><a href="<?= base_url('users/dosen') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Dosen Aktif</p></a></li>
        <li class="nav-item"><a href="<?= base_url('users/reset-password') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Reset Password</p></a></li>
        <li class="nav-item"><a href="<?= base_url('bimbingan') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Mahasiswa Bimbingan</p></a></li>

        <li class="nav-header">Lainnya</li>
        <li class="nav-item"><a href="<?= base_url('profile') ?>" class="nav-link"><i class="nav-icon far fa-circle text-danger"></i><p class="text">Profile</p></a></li>
        <li class="nav-item"><a href="<?= base_url('setting') ?>" class="nav-link"><i class="nav-icon far fa-circle text-warning"></i><p>Setting</p></a></li>
        <li class="nav-item"><a href="<?= base_url('logout') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Logout</p></a></li>
      </ul>
    </nav>
  </div>
</aside>
