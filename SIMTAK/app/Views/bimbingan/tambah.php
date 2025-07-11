<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <h2>Tambah Mahasiswa Bimbingan</h2>
    <form method="post" action="<?= base_url('bimbingan/simpan') ?>">
  <div class="form-group">
    <label>Mahasiswa</label>
    <select name="mahasiswa_id" class="form-control" required>
  <?php foreach ($mahasiswa as $m): ?>
    <option value="<?= $m['user_id'] ?>"><?= $m['nama_lengkap'] ?></option>
  <?php endforeach ?>
</select>

  </div>
  <div class="form-group">
    <label>Dosen Pembimbing</label>
    <select name="dosen_id" class="form-control">
    <?php foreach ($dosen as $d): ?>
        <option value="<?= $d['user_id'] ?>"><?= $d['nama_lengkap'] ?></option>
    <?php endforeach ?>
</select>
  </div>
 <div class="form-group">
    <label>Topik Skripsi</label>
    <select name="topik_id" class="form-control" required>
        <option value="">-- Pilih Topik --</option>
        <?php foreach ($topik as $t): ?>
            <option value="<?= $t['topik_id'] ?>">
                <?= $t['judul_topik'] ?> - <?= $t['bidang_ilmu'] ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

  <div class="form-group">
    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

</div>

<?= $this->endSection() ?>
