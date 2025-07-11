<?= $this->extend('layoutsdosen/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Form Penilaian Seminar</h4>

<form action="<?= base_url('seminar/nilai/' . $seminar['seminar_id']) ?>" method="post">
    <div class="form-group">
        <label>Nilai Presentasi</label>
        <input type="number" name="nilai_presentasi" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nilai Laporan</label>
        <input type="number" name="nilai_laporan" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nilai Tanya Jawab</label>
        <input type="number" name="nilai_tanya_jawab" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Komentar Dosen</label>
        <textarea name="komentar_dosen" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Simpan Nilai</button>
</form>

</div>

<?= $this->endSection() ?>
