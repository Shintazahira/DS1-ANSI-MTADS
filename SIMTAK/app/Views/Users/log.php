<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-clipboard-list"></i> <?= esc($title) ?></h2>
        <a href="<?= base_url('peninjau/dashboard') ?>" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>User ID</th>
                        <th>Nama Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Waktu Login</th>
                        <th>Waktu Logout</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($log)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle"></i> Belum ada aktivitas yang tercatat.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($log as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><span class="badge bg-secondary"><?= esc($row['user_id']) ?></span></td>
                                <td><?= esc($row['nama_lengkap'] ?? '-') ?></td>
                                <td><?= esc($row['aktivitas']) ?></td>
                                <td><?= $row['waktu_login'] ? date('d-m-Y H:i', strtotime($row['waktu_login'])) : '-' ?></td>
                                <td><?= $row['waktu_logout'] ? date('d-m-Y H:i', strtotime($row['waktu_logout'])) : '<span class="text-danger">Aktif</span>' ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
