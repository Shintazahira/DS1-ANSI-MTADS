<?= $this->extend('layoutsdosen/main') ?>
<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <h1><b>Dashboard Dosen</b></h1>
    <h5>User ID: <?= session()->get('user_id') ?></h5>
    <h3>Halo, <?= session()->get('nama_lengkap') ?></h3>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Mahasiswa Bimbingan -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h4>Mahasiswa Bimbingan</h4>
          </div>
          <div class="icon"><i class="fas fa-user-graduate"></i></div>
          <a href="<?= base_url('dosen/bimbingan') ?>" class="small-box-footer">Lihat Daftar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Proposal Menunggu -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h4>Proposal Menunggu</h4>
          </div>
          <div class="icon"><i class="fas fa-file-signature"></i></div>
          <a href="<?= base_url('topik') ?>" class="small-box-footer">Tinjau Proposal <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Seminar / Sidang -->
      <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h4>Seminar / Sidang</h4>
          </div>
          <div class="icon"><i class="fas fa-calendar-alt"></i></div>
          <a href="<?= base_url('seminar') ?>" class="small-box-footer">Lihat Jadwal <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->endSection() ?>
