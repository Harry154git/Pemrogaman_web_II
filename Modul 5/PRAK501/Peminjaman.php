<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $model->insert('peminjaman', [
                'id_member' => $_POST['id_member'],
                'id_buku' => $_POST['id_buku'],
                'tgl_pinjam' => $_POST['tgl_pinjam'],
                'tgl_kembali' => $_POST['tgl_kembali']
            ]);
        } elseif ($action === 'edit') {
            $model->update('peminjaman', [
                'id_member' => $_POST['id_member'],
                'id_buku' => $_POST['id_buku'],
                'tgl_pinjam' => $_POST['tgl_pinjam'],
                'tgl_kembali' => $_POST['tgl_kembali']
            ], [
                'id_peminjaman' => $_POST['id_peminjaman']
            ]);
        } elseif ($action === 'delete') {
            $model->delete('peminjaman', ['id_peminjaman' => $_POST['id_peminjaman']]);
            $peminjaman = $model->getData('peminjaman', [], ['*'], 'ORDER BY id_peminjaman');
            $newId = 1;
            foreach ($peminjaman as $row) {
                $pdo->prepare("UPDATE peminjaman SET id_peminjaman = ? WHERE id_peminjaman = ?")
                    ->execute([$newId++, $row['id_peminjaman']]);
            }
            $pdo->exec("ALTER TABLE peminjaman AUTO_INCREMENT = 1");
        }
    }
}

$peminjaman = $model->customQuery("
    SELECT p.*, m.nama_member, b.judul_buku 
    FROM peminjaman p
    INNER JOIN member m ON p.id_member = m.id_member
    INNER JOIN buku b ON p.id_buku = b.id_buku
");
$members = $model->getData('member');
$buku = $model->getData('buku');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffe6e6;
            padding: 20px;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #e60000;
        }
        form {
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control input, .form-control select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #e60000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #cc0000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #e60000;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Peminjaman Buku</h1>

        <h2>Tambah atau Edit Peminjaman</h2>
        <form method="POST">
            <input type="hidden" name="id_peminjaman" id="id_peminjaman">
            <div class="form-control">
                <label for="id_member">Member:</label>
                <select name="id_member" id="id_member" required>
                    <option value="">Pilih Member</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?= htmlspecialchars($member['id_member']) ?>"><?= htmlspecialchars($member['nama_member']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-control">
                <label for="id_buku">Buku:</label>
                <select name="id_buku" id="id_buku" required>
                    <option value="">Pilih Buku</option>
                    <?php foreach ($buku as $book): ?>
                        <option value="<?= htmlspecialchars($book['id_buku']) ?>"><?= htmlspecialchars($book['judul_buku']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-control">
                <label for="tgl_pinjam">Tanggal Pinjam:</label>
                <input type="datetime-local" name="tgl_pinjam" id="tgl_pinjam" value="<?= date('Y-m-d\TH:i') ?>" required>
            </div>
            <div class="form-control">
                <label for="tgl_kembali">Tanggal Kembali:</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali">
            </div>
            <button type="submit" name="action" value="add">Tambah</button>
            <button type="submit" name="action" value="edit">Simpan Perubahan</button>
        </form>

        <h2>Daftar Peminjaman</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Member</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peminjaman as $borrow): ?>
                    <tr>
                        <td><?= htmlspecialchars($borrow['id_peminjaman']) ?></td>
                        <td><?= htmlspecialchars($borrow['nama_member']) ?></td>
                        <td><?= htmlspecialchars($borrow['judul_buku']) ?></td>
                        <td><?= htmlspecialchars($borrow['tgl_pinjam']) ?></td>
                        <td><?= htmlspecialchars($borrow['tgl_kembali']) ?></td>
                        <td>
                            <button onclick="editPeminjaman(<?= htmlspecialchars(json_encode($borrow)) ?>)">Edit</button>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="id_peminjaman" value="<?= htmlspecialchars($borrow['id_peminjaman']) ?>">
                                <button type="submit" name="action" value="delete" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editPeminjaman(borrow) {
            document.getElementById('id_peminjaman').value = borrow.id_peminjaman;
            document.getElementById('id_member').value = borrow.id_member;
            document.getElementById('id_buku').value = borrow.id_buku;
            document.getElementById('tgl_pinjam').value = borrow.tgl_pinjam;
            document.getElementById('tgl_kembali').value = borrow.tgl_kembali;
        }
    </script>
</body>
</html>