<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Status Pengajuan Topik</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Catatan / Alasan Penolakan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengajuan as $p): ?>
                <tr>
                    <td><?= $p['judul'] ?></td>
                    <td>
                        <?php if ($p['status'] == 'menunggu'): ?>
                            <span class="badge bg-warning">Menunggu</span>
                        <?php elseif ($p['status'] == 'disetujui'): ?>
                            <span class="badge bg-success">Disetujui</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                    <td><?= $p['alasan_penolakan'] ?? '-' ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
