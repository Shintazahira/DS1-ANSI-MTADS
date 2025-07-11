<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2><?= esc($title) ?></h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Lengkap</th>
            <td><?= esc($user['nama_lengkap']) ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= esc($user['username']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= esc($user['email']) ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?= esc($user['role']) ?></td>
        </tr>
    </table>
</div>

<?= $this->endSection() ?>
