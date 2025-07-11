<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Daftar Seminar Mahasiswa</h2>
    <?php if (session()->get('role') === 'kaprodi') : ?>
        <a href="<?= base_url('seminar/tambah') ?>" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Seminar
        </a>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Seminar</th>
                    <th>Tempat</th>
                    <th>Tanggal Seminar</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <?php if (session()->get('role') === 'dosen') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
<tbody>
<?php if (!empty($seminars)) : ?>
    <?php $no = 1; foreach ($seminars as $seminar): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($seminar['nama_lengkap']) ?></td>
            <td><?= esc($seminar['judul_seminar']) ?></td>
            <td><?= esc($seminar['tempat']) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($seminar['tanggal_seminar'])) ?></td>
            <td>
                <span class="badge 
                    <?= $seminar['status'] == 'diajukan' ? 'bg-warning text-dark' : 
                        ($seminar['status'] == 'disetujui' ? 'bg-success' : 
                        ($seminar['status'] == 'selesai' ? 'bg-secondary' : 'bg-danger')) ?>">
                    <?= ucfirst($seminar['status']) ?>
                </span>
            </td>
            <td>
                <?php if ($seminar['nilai_presentasi'] !== null): ?>
                    <?= round(($seminar['nilai_presentasi'] + $seminar['nilai_laporan'] + $seminar['nilai_tanya_jawab']) / 3, 2) ?>
                <?php else: ?>
                    <span class="badge bg-warning text-dark">Belum Dinilai</span>
                <?php endif; ?>
            </td>

            <?php if (session()->get('role') === 'dosen') : ?>
                <td>
                    <a href="<?= base_url('seminar/nilai/' . $seminar['seminar_id']) ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-pen"></i> Beri Nilai
                    </a>
                </td>
            <?php endif; ?>

        </tr>
    <?php endforeach ?>
<?php else : ?>
    <tr>
        <td colspan="<?= session()->get('role') === 'dosen' ? '8' : '7' ?>" class="text-center">
            Belum ada seminar yang terdaftar.
        </td>
    </tr>
<?php endif ?>
</tbody>

        </table>
    </div>
</div>

<?= $this->endSection() ?>
