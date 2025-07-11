<?= $this->extend('layoutsdosen/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3><?= esc($title) ?></h3>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Topik</th>
            <th>Bidang Ilmu</th>
            <th>Status</th>
            <th>Dibuat Oleh</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topik as $i => $t): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($t['judul_topik']) ?></td>
                <td><?= esc($t['bidang_ilmu'] ?? '-') ?></td>
                <td><?= esc($t['status'] ?? '-') ?></td>
                <td><?= esc($t['created_by']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>

<?= $this->endSection() ?>
