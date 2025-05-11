<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

$buku = [
    'id_buku' => '',
    'judul_buku' => '',
    'penulis' => '',
    'penerbit' => '',
    'tahun_terbit' => ''
];
if (isset($_GET['id_buku'])) {
    $bukuData = $model->getData('buku', ['id_buku' => $_GET['id_buku']]);
    if (!empty($bukuData)) {
        $buku = $bukuData[0];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    if ($id_buku) {
        $model->update('buku', [
            'judul_buku' => $judul_buku,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit
        ], [
            'id_buku' => $id_buku
        ]);
    } else {
        $model->insert('buku', [
            'judul_buku' => $judul_buku,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit
        ]);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('/Modul 5/PRAK501/gambar/image_book.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 243, 176, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-control input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #ffa500;
            color: white;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-actions button:hover {
            background-color: #ff8c00;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1><?= $buku['id_buku'] ? 'Edit Buku' : 'Tambah Buku' ?></h1>
        <form method="POST">
            <input type="hidden" name="id_buku" value="<?= htmlspecialchars($buku['id_buku']) ?>">

            <div class="form-control">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku" value="<?= htmlspecialchars($buku['judul_buku']) ?>" required>
            </div>

            <div class="form-control">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" id="penulis" value="<?= htmlspecialchars($buku['penulis']) ?>" required>
            </div>

            <div class="form-control">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" value="<?= htmlspecialchars($buku['penerbit']) ?>" required>
            </div>

            <div class="form-control">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>