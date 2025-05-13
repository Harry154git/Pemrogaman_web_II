<?= view('navigasi/navigasi') ?>

<div class="container mt-5">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-primary text-dark text-center">
            <h1>Beranda</h1>
        </div>
        <div class="card-body text-center">
            <p>Nama : <?= $nama ?></p>
            <p>NIM : <?= $nim ?></p>
        </div>
    </div>
</div>

<script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>