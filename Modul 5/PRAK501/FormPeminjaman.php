<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

$peminjaman = [
    'id_peminjaman' => '',
    'id_member' => '',
    'id_buku' => '',
    'tgl_pinjam' => '',
    'tgl_kembali' => ''
];
if (isset($_GET['id_peminjaman'])) {
    $peminjamanData = $model->getData('peminjaman', ['id_peminjaman' => $_GET['id_peminjaman']]);
    if (!empty($peminjamanData)) {
        $peminjaman = $peminjamanData[0];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_member = $_POST['id_member'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    if ($id_peminjaman) {
        $model->update('peminjaman', [
            'id_member' => $id_member,
            'id_buku' => $id_buku,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali
        ], [
            'id_peminjaman' => $id_peminjaman
        ]);
    } else {
        $model->insert('peminjaman', [
            'id_member' => $id_member,
            'id_buku' => $id_buku,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali
        ]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <style>
        body {
            background-image:  url('/Modul 5/PRAK501/gambar/image_peminjaman.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: white;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .form-container h1 {
            text-align: center;
            color: white;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #e60000;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-actions button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1><?= $peminjaman['id_peminjaman'] ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?></h1>
        <form method="POST">
            <input type="hidden" name="id_peminjaman" value="<?= htmlspecialchars($peminjaman['id_peminjaman']) ?>">

            <div class="form-control">
                <label for="id_member">ID Member</label>
                <input type="number" name="id_member" id="id_member" value="<?= htmlspecialchars($peminjaman['id_member']) ?>" required>
            </div>

            <div class="form-control">
                <label for="id_buku">ID Buku</label>
                <input type="number" name="id_buku" id="id_buku" value="<?= htmlspecialchars($peminjaman['id_buku']) ?>" required>
            </div>

            <div class="form-control">
                <label for="tgl_pinjam">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-control">
                <label for="tgl_kembali">Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali" value="<?= htmlspecialchars($peminjaman['tgl_kembali']) ?>">
            </div>

            <div class="form-actions">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>