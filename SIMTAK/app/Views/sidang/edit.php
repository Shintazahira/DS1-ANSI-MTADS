<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Edit Sidang</h3>
<form action="<?= base_url('sidang/update/' . $sidang['sidang_id']) ?>" method="post">
    <div class="form-group">
        <label>Tanggal Sidang</label>
        <input type="datetime-local" name="tanggal_sidang" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($sidang['tanggal_sidang'])) ?>" required>
    </div>
    <div class="form-group">
        <label>Tempat</label>
        <input type="text" name="tempat" class="form-control" value="<?= $sidang['tempat'] ?>" required>
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="terjadwal" <?= $sidang['status'] == 'terjadwal' ? 'selected' : '' ?>>Terjadwal</option>
            <option value="berlangsung" <?= $sidang['status'] == 'berlangsung' ? 'selected' : '' ?>>Berlangsung</option>
            <option value="selesai" <?= $sidang['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nilai Akhir</label>
        <input type="number" step="0.01" name="nilai_akhir" class="form-control" value="<?= $sidang['nilai_akhir'] ?>">
    </div>
    <div class="form-group">
        <label>Catatan Dewan</label>
        <textarea name="catatan_dewan" class="form-control"><?= $sidang['catatan_dewan'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Perbarui</button>
</form>
<?= $this->endSection() ?>