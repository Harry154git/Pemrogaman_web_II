<?= view('navigasi/navigasi') ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h1>Profil</h1>
        </div>
        <div class="card-body">
            <img src="<?= base_url('image/' . $gambar) ?>" alt="<?= $nama ?>" width="200">
            <p>Nama: <?= $nama ?></p>
            <p>NIM: <?= $nim ?></p>
            <p>Asal Prodi: <?= $asalprodi ?></p>
            <p>Hobi: <?= $hobi ?></p>
            <p>Skill: <?= $skill ?></p>
        </div>
    </div>
</div>
<script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>