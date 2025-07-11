<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Tambah Seminar</h2>

    <a href="<?= base_url('dashboard/kaprodi') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/seminar/simpan') ?>" method="post" class="mb-4">
        <div class="form-group">
            <label>Pilih Mahasiswa (Bimbingan)</label>
            <select name="bimbingan_id" class="form-control" required>
                <option value="">-- Pilih Mahasiswa --</option>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <option value="<?= $mhs['bimbingan_id'] ?>">
                        <?= $mhs['mahasiswa_id'] ?> - <?= $mhs['nama_lengkap'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Tambahkan Dropdown Dosen Pembimbing -->
        <div class="form-group">
            <label>Pilih Dosen Pembimbing</label>
            <select name="dosen_id" class="form-control" required>
                <option value="">-- Pilih Dosen Pembimbing --</option>
                <?php foreach ($dosen as $dsn): ?>
                    <option value="<?= $dsn['user_id'] ?>">
                        <?= $dsn['nama_lengkap'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label>Judul Seminar</label>
            <input type="text" name="judul_seminar" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Abstrak</label>
            <textarea name="abstrak" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Tanggal dan Waktu Seminar</label>
            <input type="datetime-local" name="tanggal_seminar" class="form-control" 
       value="<?= date('Y-m-d\TH:i') ?>" required>
        </div>

        <div class="form-group">
            <label>Tempat</label>
            <input type="text" name="tempat" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Tambah Peserta Seminar</button>
    </form>
</div>

<?= $this->endSection() ?>
