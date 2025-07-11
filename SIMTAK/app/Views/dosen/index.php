<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Daftar Dosen</h2>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <a href="<?= base_url('dosen/tambah') ?>" class="btn btn-success mb-2">Tambah Dosen</a>
        <a href="<?= base_url('dashboard/kaprodi') ?>" class="btn btn-primary mb-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>NIDN</th>
                <th>Jabatan Akademik</th>
                <th>Bidang Keahlian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dosen as $d): ?>
                <tr>
                    <td><?= $d['nama_lengkap'] ?></td>
                    <td><?= $d['nidn'] ?></td>
                    <td><?= $d['jabatan_akademik'] ?></td>
                    <td><?= $d['bidang_keahlian'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
