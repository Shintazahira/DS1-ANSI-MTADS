<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Tambah Sidang</h3>
<form action="<?= base_url('sidang/store') ?>" method="post">
<div class="form-group">
    <label>Mahasiswa</label>
    <select name="seminar_id" class="form-control" required>
        <?php foreach ($seminar as $s): ?>
            <option value="<?= $s['seminar_id'] ?>">
                <?= $s['nama_lengkap'] ?> (Seminar ID: <?= $s['seminar_id'] ?>)
            </option>
        <?php endforeach ?>
    </select>
</div>

    <div class="form-group">
        <label>Tanggal Sidang</label>
        <input type="datetime-local" name="tanggal_sidang" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Tempat</label>
        <input type="text" name="tempat" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="terjadwal">Terjadwal</option>
            <option value="berlangsung">Berlangsung</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nilai Akhir</label>
        <input type="number" step="0.01" name="nilai_akhir" class="form-control">
    </div>
    <div class="form-group">
        <label>Catatan Dewan</label>
        <textarea name="catatan_dewan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?= $this->endSection() ?>