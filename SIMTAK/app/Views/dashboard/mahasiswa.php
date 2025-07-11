<?= $this->extend('layoutsmahasiswa/main') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1><b>Dashboard Mahasiswa</b></h1>
        <h5>User ID: <?= session()->get('user_id') ?></h5>
        <h3>Halo, <?= session()->get('nama_lengkap') ?></h3>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Status Topik Skripsi (Pengajuan) -->
            <div class="col-md-3">
                <a href="<?= base_url('pengajuan/create') ?>" style="text-decoration: none; color: inherit;">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Ajukan Topik Skripsi</h4>
                            <p><?= $topik['status'] ?? 'Ajukan Topik' ?></p>
                        </div>
                        <div class="icon"><i class="fas fa-lightbulb"></i></div>
                    </div>
                </a>
            </div>

            <!-- Status Bimbingan -->
            <div class="col-md-3">
                <a href="<?= base_url('mahasiswa/bimbingan') ?>" style="text-decoration: none; color: inherit;">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>Status Bimbingan</h4>
                            <p><?= $bimbingan['status'] ?? '-' ?></p>
                        </div>
                        <div class="icon"><i class="fas fa-user-tie"></i></div>
                    </div>
                </a>
            </div>

            <!-- Status Seminar -->
                <div class="col-md-3">
                    <a href="<?= base_url('mahasiswa/seminar') ?>" style="text-decoration: none; color: inherit;">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h4>Status Seminar</h4>
                                <p><?= $seminar['status'] ?? '-' ?></p>
                            </div>
                            <div class="icon"><i class="fas fa-presentation"></i></div>
                        </div>
                    </a>
                </div>

            <!-- Box: Status Sidang -->
            <div class="col-md-3">
                <a href="<?= base_url('sidang/mahasiswa') ?>" style="text-decoration: none; color: inherit;">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h4>Status Sidang</h4>
                            <p><?= $sidang['status'] ?? '-' ?></p>
                        </div>
                        <div class="icon"><i class="fas fa-gavel"></i></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
