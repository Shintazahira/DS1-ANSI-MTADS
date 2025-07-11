<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h3 class="mb-3">Reset Password</h3>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('users/process-reset') ?>" method="post">
                <div class="form-group mb-2">
                    <label for="email">Masukkan Email Anda</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning mt-2">Kirim Link Reset</button>
                <a href="<?= base_url('peninjau/dashboard') ?>" class="btn btn-primary mt-2 float-end">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
