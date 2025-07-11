<?= $this->extend('layoutskaprodi/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Tambah Dosen</h2>
<form method="post" action="<?= base_url('dosen/simpan') ?>">
    <div class="form-group">
        <label for="nama_lengkap">Nama Dosen</label>
        <input type="text" name="nama_lengkap" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nidn">NIDN</label>
        <input type="text" name="nidn" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="jabatan_akademik">Jabatan Akademik</label>
        <input type="text" name="jabatan_akademik" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="bidang_keahlian">Bidang Keahlian</label>
        <input type="text" name="bidang_keahlian" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

</div>

<?= $this->endSection() ?>
