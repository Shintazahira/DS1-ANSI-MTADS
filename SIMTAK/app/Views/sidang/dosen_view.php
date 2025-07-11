<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h4>Daftar Sidang Mahasiswa</h4>
<table class="table table-bordered">
    <thead><tr><th>Seminar ID</th><th>Tanggal</th><th>Tempat</th><th>Status</th><th>Nilai</th></tr></thead>
    <tbody>
        <?php foreach ($sidang as $s): ?>
        <tr>
            <td><?= $s['seminar_id'] ?></td>
            <td><?= $s['tanggal_sidang'] ?></td>
            <td><?= $s['tempat'] ?></td>
            <td><?= $s['status'] ?></td>
            <td><?= $s['nilai_akhir'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>
