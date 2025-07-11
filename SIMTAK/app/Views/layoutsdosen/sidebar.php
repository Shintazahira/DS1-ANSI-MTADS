<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
    <!-- User Panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="<?= base_url('dashboard/dosen') ?>" class="d-block">Dashboard Dosen</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?= base_url('dashboard/dosen') ?>" class="nav-link <?= current_url() == base_url('dashboard/dosen') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">Menu Dosen</li>

        <!-- Mahasiswa Bimbingan -->
        <li class="nav-item">
          <a href="<?= base_url('dosen/bimbingan') ?>" class="nav-link <?= current_url() == base_url('dosen/bimbingan') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Mahasiswa Bimbingan</p>
          </a>
        </li>

        <!-- Profil -->
        <li class="nav-item">
          <a href="<?= base_url('profile') ?>" class="nav-link <?= current_url() == base_url('profile') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>Profil</p>
          </a>
        </li>

        <!-- Logout -->
        <li class="nav-item">
          <a href="<?= base_url('logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>
