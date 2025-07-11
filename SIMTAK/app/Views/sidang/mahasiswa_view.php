<?= $this->extend('layoutsmahasiswa/main') ?>
<?= $this->section('content') ?>
<h4>Status Sidang Anda</h4>
<?php if ($sidang): ?>
<table class="table table-bordered">
    <tr><th>Tanggal</th><td><?= $sidang['tanggal_sidang'] ?></td></tr>
    <tr><th>Tempat</th><td><?= $sidang['tempat'] ?></td></tr>
    <tr><th>Status</th><td><?= $sidang['status'] ?></td></tr>
    <tr><th>Nilai Akhir</th><td><?= $sidang['nilai_akhir'] ?></td></tr>
    <tr><th>Catatan Dewan</th><td><?= $sidang['catatan_dewan'] ?></td></tr>
</table>
<?php else: ?>
<p>Belum ada data sidang.</p>
<?php endif ?>
<?= $this->endSection() ?>
