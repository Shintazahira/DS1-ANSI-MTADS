<?= $this->extend('layoutsmahasiswa/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Ajukan Topik Skripsi</h3>

    <?php if (isset($pengajuan) && $pengajuan): ?>
        <div class="mb-4">
            <h5>Status Pengajuan Terakhir</h5>
            <table class="table table-bordered">
                <tr><th>Judul</th><td><?= esc($pengajuan['judul']) ?></td></tr>
                <tr><th>Status</th>
                    <td>
                        <?php if ($pengajuan['status'] == 'disetujui'): ?>
                            <span class="badge bg-success">Disetujui</span>
                        <?php elseif ($pengajuan['status'] == 'ditolak'): ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                        <?php endif ?>
                    </td>
                </tr>
                <tr><th>Catatan Kaprodi</th><td><?= esc($pengajuan['alasan_penolakan'] ?? '-') ?></td></tr>
                <tr><th>Diunggah Pada</th><td><?= date('d-m-Y H:i', strtotime($pengajuan['created_at'])) ?></td></tr>
            </table>
        </div>
    <?php endif ?>

    <?php if (!isset($pengajuan['status']) || $pengajuan['status'] != 'disetujui'): ?>
        <form action="<?= base_url('pengajuan/store') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Judul Skripsi</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group mt-2">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group mt-2">
                <label>Upload Proposal (PDF, opsional)</label>
                <input type="file" name="file_proposal" class="form-control">
            </div>

            <button class="btn btn-primary mt-3" type="submit">Kirim Pengajuan</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info">
            Anda sudah mengajukan dan pengajuan Anda <strong>disetujui</strong>. Tidak dapat mengirim ulang.
        </div>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
