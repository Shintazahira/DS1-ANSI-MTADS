<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard Tim Peninjau</h1>
          <h3>Halo, <?= session()->get('nama_lengkap') ?></h3>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h4>Mahasiswa Aktif</h4>
              <p>Lihat Hasil Register</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="<?= base_url('users/mahasiswa') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>Dosen Aktif</h4>
              <p>Lihat Hasil Register</p>
            </div>
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <a href="<?= base_url('users/dosen') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h4>Reset Password</h4>
              <p>Fitur Akses Cepat</p>
            </div>
            <div class="icon"><i class="fas fa-unlock-alt"></i></div>
            <a href="<?= base_url('users/reset-password') ?>" class="small-box-footer">Reset Sekarang <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h4>Log Aktivitas</h4>
              <p>Monitoring Login</p>
            </div>
            <div class="icon"><i class="fas fa-history"></i></div>
            <a href="<?= base_url('users/log') ?>" class="small-box-footer">Lihat Log <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header bg-light">
          <h5 class="card-title mb-0">Registrasi Akun Baru</h5>
        </div>
        <div class="card-body">
          <form action="<?= base_url('users/register') ?>" method="post">
            <div class="row mb-3">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukkan NIM/NIDN" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Password (Tanggal Lahir)</label>
                  <input type="date" name="tanggal_lahir" class="form-control" required>
                  <small class="form-text text-muted">Format password otomatis dari tanggal ini.</small>
                </div>
              </div>
            </div>

            <div class="row align-items-end">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Role</label>
                  <select name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="kaprodi">Kaprodi</option>
                    <option value="tim_peninjau">Tim Peninjau</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-success w-100 mb-3">Daftarkan Akun</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card bg-gradient-primary mt-4">
        <div class="card-body">
          <h5 class="text-white mb-1">Lokasi Kampus</h5>
          <iframe 
            src="https://www.google.com/maps?q=Universitas%20Muhammadiyah%20Bima&output=embed"
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen 
            loading="lazy">
          </iframe>
        </div>
      </div>

    </div>
  </section>
</div>

<?= $this->endSection() ?>
