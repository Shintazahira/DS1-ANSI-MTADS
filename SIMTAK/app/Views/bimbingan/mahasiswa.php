<?= $this->extend('layoutsmahasiswa/main') ?>
<?= $this->section('content') ?>

<h3><?= $title ?></h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Dosen Pembimbing</th>
            <th>Tanggal Mulai</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($bimbingan)): ?>
            <tr><td colspan="4">Belum ada jadwal bimbingan.</td></tr>
        <?php else: ?>
            <?php foreach ($bimbingan as $b): ?>
                <tr>
                    <td><?= esc($b['nama_dosen']) ?></td>
                    <td><?= esc($b['tanggal_mulai']) ?></td>
                    <td><?= esc($b['status']) ?></td>
                    <td><?= esc($b['catatan'] ?? '-') ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?= $this->endSection() ?>
