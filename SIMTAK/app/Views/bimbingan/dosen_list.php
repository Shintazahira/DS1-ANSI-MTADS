<?= $this->extend('layoutsdosen/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2><?= $title ?? 'Daftar Mahasiswa Bimbingan' ?></h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Topik</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($bimbingan)) : ?>
                <?php foreach ($bimbingan as $index => $item) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['nama_mahasiswa']) ?></td>
                        <td><?= esc($item['topik'] ?? '-') ?></td>
                        <td><?= esc($item['status']) ?></td>
                        <td><?= esc($item['tanggal_mulai']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5" class="text-center">Tidak ada data bimbingan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
