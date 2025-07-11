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
          <a href="<?= base_url('mahasiswa/dashboard') ?>" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">Layout Options</li>
        <li class="nav-item"><a href="<?= base_url('pengajuan/create') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Ajukan Topik Skripsi</p></a></li>
        <li class="nav-item"><a href="<?= base_url('mahasiswa/bimbingan') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Status Bimbingan</p></a></li>
        <li class="nav-item"><a href="<?= base_url('mahasiswa/seminar') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Status Seminar</p></a></li>
        <li class="nav-item"><a href="<?= base_url('sidang/mahasiswa') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Status Sidang</p></a></li>

        <li class="nav-header">Lainnya</li>
        <li class="nav-item"><a href="<?= base_url('profile') ?>" class="nav-link"><i class="nav-icon far fa-circle text-danger"></i><p class="text">Profile</p></a></li>
        <li class="nav-item"><a href="<?= base_url('setting') ?>" class="nav-link"><i class="nav-icon far fa-circle text-warning"></i><p>Setting</p></a></li>
        <li class="nav-item"><a href="<?= base_url('logout') ?>" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Logout</p></a></li>
      </ul>
    </nav>
  </div>
</aside>
