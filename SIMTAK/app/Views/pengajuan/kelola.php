<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Kelola Pengajuan Topik Skripsi</h3>
        <a href="<?= base_url('dashboard/kaprodi') ?>" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama Mahasiswa</th>
      <th>Judul</th>
      <th>Deskripsi</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pengajuan as $item): ?>
      <tr>
        <td><?= $item['nama_mahasiswa'] ?></td>
        <td><?= $item['judul'] ?></td>
        <td><?= $item['deskripsi'] ?></td>
        <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
        <td><?= ucfirst($item['status']) ?></td>
        <td>
          <?php if ($item['status'] === 'menunggu'): ?>
            <a href="<?= base_url('pengajuan/setuju/' . $item['id']) ?>" class="btn btn-success btn-sm">Setujui</a>
            <a href="<?= base_url('pengajuan/tolak/' . $item['id']) ?>" class="btn btn-danger btn-sm">Tolak</a>
          <?php else: ?>
            -
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<?= $this->endSection() ?>
