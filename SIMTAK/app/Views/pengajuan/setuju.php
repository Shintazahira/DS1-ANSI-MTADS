<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Setujui Pengajuan</h3>

    <?php if (!empty($pengajuan)): ?>
        <form action="<?= base_url('pengajuan/simpan-setuju') ?>" method="post">
            <?php $pengajuan_id = isset($pengajuan['id']) ? $pengajuan['id'] : ''; ?>
            <input type="hidden" name="pengajuan_id" value="<?= esc($pengajuan['id']) ?>">

            <div class="form-group">
                <label for="judul">Judul Skripsi</label>
                <input type="text" class="form-control" value="<?= $pengajuan['judul'] ?>" readonly>
            </div>

            <div class="form-group">
                <label for="dosen_id">Pilih Dosen Pembimbing</label>
                <select name="dosen_id" class="form-control" required>
                    <option value="">-- Pilih Dosen --</option>
                    <?php foreach ($dosen as $d): ?>
                        <option value="<?= $d['dosen_id'] ?>"><?= $d['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Setujui & Tetapkan Pembimbing</button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">Data pengajuan tidak ditemukan.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
