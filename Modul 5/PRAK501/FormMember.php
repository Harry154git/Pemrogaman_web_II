<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

$member = [
    'id_member' => '',
    'nama_member' => '',
    'nomor_member' => '',
    'alamat' => '',
    'tgl_mendaftar' => '',
    'tgl_terakhir_bayar' => ''
];
if (isset($_GET['id_member'])) {
    $memberData = $model->getData('member', ['id_member' => $_GET['id_member']]);
    if (!empty($memberData)) {
        $member = $memberData[0];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_member = $_POST['id_member'];
    $nama_member = $_POST['nama_member'];
    $nomor_member = $_POST['nomor_member'];
    $alamat = $_POST['alamat'];
    $tgl_mendaftar = $_POST['tgl_mendaftar'];
    $tgl_terakhir_bayar = $_POST['tgl_terakhir_bayar'];

    if ($id_member) {
        $model->update('member', [
            'nama_member' => $nama_member,
            'nomor_member' => $nomor_member,
            'alamat' => $alamat,
            'tgl_mendaftar' => $tgl_mendaftar,
            'tgl_terakhir_bayar' => $tgl_terakhir_bayar
        ], [
            'id_member' => $id_member
        ]);
    } else {
        $model->insert('member', [
            'nama_member' => $nama_member,
            'nomor_member' => $nomor_member,
            'alamat' => $alamat,
            'tgl_mendaftar' => $tgl_mendaftar,
            'tgl_terakhir_bayar' => $tgl_terakhir_bayar
        ]);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembuatan Member</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:  url('/Modul 5/PRAK501/gambar/image_people.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(173, 216, 230, 0.8); 
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            color: #004085;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #004085;
        }

        .form-control input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
            border: 1px solid #004085;
            border-radius: 4px;
        }

        .form-actions {
            text-align: center;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff; /* Blue */
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-actions button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1><?= $member['id_member'] ? 'Edit Member' : 'Tambah Member' ?></h1>
        <form method="POST">
            <input type="hidden" name="id_member" value="<?= htmlspecialchars($member['id_member']) ?>">

            <div class="form-control">
                <label for="nama_member">Nama Member</label>
                <input type="text" name="nama_member" id="nama_member" value="<?= htmlspecialchars($member['nama_member']) ?>" required>
            </div>

            <div class="form-control">
                <label for="nomor_member">Nomor Member</label>
                <input type="text" name="nomor_member" id="nomor_member" value="<?= htmlspecialchars($member['nomor_member']) ?>" required>
            </div>

            <div class="form-control">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($member['alamat']) ?>" required>
            </div>

            <div class="form-control">
                <label for="tgl_mendaftar">Tanggal Mendaftar</label>
                <input type="datetime-local" name="tgl_mendaftar" id="tgl_mendaftar" value="<?= date('Y-m-d\TH:i') ?>" required>
            </div>

            <div class="form-control">
                <label for="tgl_terakhir_bayar">Tanggal Terakhir Bayar</label>
                <input type="date" name="tgl_terakhir_bayar" id="tgl_terakhir_bayar" value="<?= htmlspecialchars($member['tgl_terakhir_bayar']) ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>