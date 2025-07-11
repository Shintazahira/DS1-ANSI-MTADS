<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>

<div class="content-header">
  <div class="container-fluid">
    <h1><b>Dashboard Kaprodi</b></h1>
    <h5>User ID: <?= session()->get('user_id') ?></h5>
    <h3>Halo, <?= session()->get('nama_lengkap') ?></h3>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Kolom kiri (grafik) -->
      <div class="col-md-8">
        <!-- Statistik Pengajuan Topik -->
        <div class="card">
          <div class="card-header bg-info">
            <h5 class="card-title text-white">Statistik Pengajuan Topik Skripsi</h5>
          </div>
          <div class="card-body">
            <canvas id="pengajuanChart" style="max-width: 100%; max-height: 500px;"></canvas>
          </div>
        </div>

      </div>

      <!-- Kolom kanan (box informasi) -->
      <div class="col-md-4">

        <!-- Box: Status Sidang -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h4>Tambah Peserta Sidang</h4>
            <p>Kelola status sidang mahasiswa</p>
          </div>
          <div class="icon"><i class="fas fa-gavel"></i></div>
          <a href="<?= base_url('sidang/kaprodi') ?>" class="small-box-footer">
            Kelola Sidang <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>

        <!-- Box: Bimbingan -->
        <div class="small-box bg-info">
          <div class="inner">
            <h4>Tambah Peserta Bimbingan</h4>
            <p>Tambah</p>
          </div>
          <div class="icon"><i class="fas fa-users"></i></div>
          <a href="<?= base_url('bimbingan') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>

        <!-- Box: Seminar -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h4>Tambah Peserta Seminar</h4>
            <p>Jumlah seminar yang tersedia</p>
          </div>
          <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
          <a href="<?= base_url('seminar') ?>" class="small-box-footer">Lihat Jadwal <i class="fas fa-arrow-circle-right"></i></a>
        </div>

        <!-- Box: Dosen -->
        <div class="small-box bg-success">
          <div class="inner">
            <h4>Tambah Dosen</h4>
            <p>Lihat dan Tambah Dosen</p>
          </div>
          <div class="icon"><i class="fas fa-user-tie"></i></div>
          <a href="<?= base_url('dosen') ?>" class="small-box-footer">Kelola Dosen <i class="fas fa-arrow-circle-right"></i></a>
        </div>

        <!-- Box: Kelola Pengajuan -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h4>Pengajuan Topik</h4>
            <p>Kelola pengajuan topik mahasiswa</p>
          </div>
          <div class="icon"><i class="fas fa-book-open"></i></div>
          <a href="<?= base_url('pengajuan/kelola') ?>" class="small-box-footer">Lihat Pengajuan <i class="fas fa-arrow-circle-right"></i></a>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = <?= $chartLabels ?? '[]' ?>;
  const data = <?= $chartData ?? '[]' ?>;

  if (labels.length && data.length) {
    // Tentukan warna berdasarkan status
    const backgroundColor = labels.map(status => {
      if (status.toLowerCase().includes('setuju')) return '#28a745';   // hijau
      if (status.toLowerCase().includes('tolak')) return '#dc3545';    // merah
      if (status.toLowerCase().includes('tunda') || status.toLowerCase().includes('menunggu')) return '#ffc107'; // kuning
      return '#007bff'; // default biru
    });

    const ctx = document.getElementById('pengajuanChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Pengajuan',
          data: data,
          backgroundColor: backgroundColor,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
          title: {
            display: true,
          }
        }
      }
    });
  } else {
    document.getElementById('pengajuanChart').parentElement.innerHTML =
      '<p class="text-muted text-center">Belum ada data pengajuan untuk ditampilkan.</p>';
  }
</script>

<?= $this->endSection() ?>
