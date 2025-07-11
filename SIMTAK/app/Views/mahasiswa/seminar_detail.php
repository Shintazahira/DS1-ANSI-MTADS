<?= $this->extend('layoutsmahasiswa/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Daftar Seminar Saya</h4>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Dosen Pembimbing</th>
                <th>Tempat</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Komentar Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($seminars)) : ?>
                <?php foreach ($seminars as $s) : ?>
                    <tr>
                        <td><?= esc($s['judul_seminar']) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($s['tanggal_seminar'])) ?></td>
                        <td><?= esc($s['tempat']) ?></td>
                        <td><?= ucfirst($s['status']) ?></td>
                        <td>
                            <?php if ($s['nilai_presentasi'] !== null): ?>
                                <?= round(($s['nilai_presentasi'] + $s['nilai_laporan'] + $s['nilai_tanya_jawab']) / 3, 2) ?>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Belum Dinilai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $s['komentar_dosen'] ?? '<em>-</em>' ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada seminar.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
