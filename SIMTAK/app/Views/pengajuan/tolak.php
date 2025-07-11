<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Tolak Pengajuan</h3>

    <form action="<?= base_url('pengajuan/simpan-tolak') ?>" method="post">
        <input type="hidden" name="pengajuan_id" value="<?= esc($id) ?>">

        <div class="form-group">
            <label for="alasan_penolakan">Alasan Penolakan</label>
            <textarea name="alasan_penolakan" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger mt-2">Tolak Pengajuan</button>
    </form>
</div>

<?= $this->endSection() ?>
