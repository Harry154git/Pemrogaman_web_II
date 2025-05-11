<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $model->insert('buku', [
                'judul_buku' => $_POST['judul_buku'],
                'penulis' => $_POST['penulis'],
                'penerbit' => $_POST['penerbit'],
                'tahun_terbit' => $_POST['tahun_terbit']
            ]);
        } elseif ($action === 'edit') {
            $model->update('buku', [
                'judul_buku' => $_POST['judul_buku'],
                'penulis' => $_POST['penulis'],
                'penerbit' => $_POST['penerbit'],
                'tahun_terbit' => $_POST['tahun_terbit']
            ], [
                'id_buku' => $_POST['id_buku']
            ]);
        } elseif ($action === 'delete') {
            $model->delete('buku', ['id_buku' => $_POST['id_buku']]);
            $buku = $model->getData('buku', [], ['*'], 'ORDER BY id_buku');
            $newId = 1;
            foreach ($buku as $row) {
                $pdo->prepare("UPDATE buku SET id_buku = ? WHERE id_buku = ?")
                    ->execute([$newId++, $row['id_buku']]);
            }
            $pdo->exec("ALTER TABLE buku AUTO_INCREMENT = 1");
        }

    }
}

$buku = $model->getData('buku');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff3b0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 800px;
        }
        h1, h2 {
            text-align: center;
            color: #444;
        }
        form {
            margin-bottom: 20px;
        }
        .form-control {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-control label {
            flex: 1;
            font-size: 1.1em;
            margin-right: 10px;
        }
        .form-control input {
            flex: 2;
            font-size: 1.1em;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            font-size: 1.1em;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #ffa500;
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background-color: #ff8c00;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff9e6;
            border-radius: 5px;
            overflow: hidden;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size: 1.1em;
        }
        th {
            background-color: #ffa500;
            color: white;
        }
        tbody tr:nth-child(odd) {
            background-color: #fff3cc;
        }
        tbody tr:hover {
            background-color: #ffeeba;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabel Buku</h1>

        <h2>Tambah atau Edit Buku</h2>
        <form method="POST">
            <input type="hidden" name="id_buku" id="id_buku">
            <div class="form-control">
                <label for="judul_buku">Judul Buku:</label>
                <input type="text" name="judul_buku" id="judul_buku" required>
            </div>
            <div class="form-control">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" required>
            </div>
            <div class="form-control">
                <label for="penerbit">Penerbit:</label>
                <input type="text" name="penerbit" id="penerbit" required>
            </div>
            <div class="form-control">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="text" name="tahun_terbit" id="tahun_terbit" required>
            </div>
            <button type="submit" name="action" value="add">Tambah</button>
            <button type="submit" name="action" value="edit">Simpan Perubahan</button>
        </form>

        <h2>Daftar Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buku as $buku): ?>
                    <tr>
                        <td><?= htmlspecialchars($buku['id_buku']) ?></td>
                        <td><?= htmlspecialchars($buku['judul_buku']) ?></td>
                        <td><?= htmlspecialchars($buku['penulis']) ?></td>
                        <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                        <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                        <td class="actions">
                            <button onclick="editBuku(<?= htmlspecialchars(json_encode($buku)) ?>)">Edit</button>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="id_buku" value="<?= htmlspecialchars($buku['id_buku']) ?>">
                                <button type="submit" name="action" value="delete" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editBuku(buku) {
            document.getElementById('id_buku').value = buku.id_buku;
            document.getElementById('judul_buku').value = buku.judul_buku;
            document.getElementById('penulis').value = buku.penulis;
            document.getElementById('penerbit').value = buku.penerbit;
            document.getElementById('tahun_terbit').value = buku.tahun_terbit;
        }
    </script>
</body>
</html>