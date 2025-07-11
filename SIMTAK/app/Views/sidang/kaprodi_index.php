<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>
<h3>Manajemen Sidang</h3>
<a href="<?= base_url('sidang/create') ?>" class="btn btn-primary mb-2">Tambah Sidang</a>
<a href="<?= base_url('dashboard/kaprodi') ?>" class="btn btn-primary mb-2">
    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
</a>
<table class="table table-bordered">
    <thead><tr><th>Seminar ID</th><th>Tanggal</th><th>Tempat</th><th>Status</th><th>Nilai</th><th>Aksi</th></tr></thead>
    <tbody>
        <?php foreach ($sidang as $s): ?>
        <tr>
            <td><?= $s['seminar_id'] ?></td>
            <td><?= $s['tanggal_sidang'] ?></td>
            <td><?= $s['tempat'] ?></td>
            <td><?= $s['status'] ?></td>
            <td><?= $s['nilai_akhir'] ?></td>
            <td><a href="<?= base_url('sidang/edit/' . $s['sidang_id']) ?>" class="btn btn-warning btn-sm">Edit</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>
