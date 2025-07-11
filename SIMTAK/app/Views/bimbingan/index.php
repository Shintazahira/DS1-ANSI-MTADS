<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h3><?= $title ?></h3>
    <a href="<?= base_url('dashboard/kaprodi') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

<!-- Form Tambah Bimbingan -->
<div class="card mb-4">
    <div class="card-header">Tambah Bimbingan</div>
    <div class="card-body">
        <form action="<?= base_url('bimbingan/simpan') ?>" method="post">
            <div class="row">
                <div class="col-md-5">
                    <label>Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php foreach ($mahasiswa as $m): ?>
                            <option value="<?= $m['mahasiswa_id'] ?>"><?= $m['nama_lengkap'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-5">
                    <label>Dosen Pembimbing</label>
                    <select name="dosen_id" class="form-control" required>
                        <option value="">-- Pilih Dosen --</option>
<?php foreach ($dosen as $d): ?>
    <option value="<?= $d['dosen_id'] ?>"><?= $d['nama_lengkap'] ?></option>
<?php endforeach; ?>

                    </select>
                </div>

<div class="col-md-2">
    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" class="form-control" required>
</div>

<div class="col-md-2 d-flex align-items-end">
    <button type="submit" class="btn btn-success w-100">Simpan</button>
</div>

            </div>
        </form>
    </div>
</div>


    <!-- Tabel Bimbingan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Nama Dosen</th>
                <th>Tanggal Mulai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($bimbingan)): ?>
                <?php $no = 1; foreach ($bimbingan as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_mahasiswa'] ?? '-' ?></td>
                        <td><?= $row['nama_dosen'] ?? '-' ?></td>
                        <td><?= $row['tanggal_mulai'] ?></td>
                        <td><?= $row['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data bimbingan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
