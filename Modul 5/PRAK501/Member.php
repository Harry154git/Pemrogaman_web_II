<?php
require_once 'Koneksi.php';
require_once 'Model.php';

$pdo = new PDO($dsn, $user, $password);
$model = new Model($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $model->insert('member', [
                'nama_member' => $_POST['nama_member'],
                'nomor_member' => $_POST['nomor_member'],
                'alamat' => $_POST['alamat'],
                'tgl_mendaftar' => $_POST['tgl_mendaftar'],
                'tgl_terakhir_bayar' => $_POST['tgl_terakhir_bayar']
            ]);
        } elseif ($action === 'edit') {
            $model->update('member', [
                'nama_member' => $_POST['nama_member'],
                'nomor_member' => $_POST['nomor_member'],
                'alamat' => $_POST['alamat'],
                'tgl_mendaftar' => $_POST['tgl_mendaftar'],
                'tgl_terakhir_bayar' => $_POST['tgl_terakhir_bayar']
            ], [
                'id_member' => $_POST['id_member']
            ]);
        } elseif ($action === 'delete') {
            $model->delete('member', ['id_member' => $_POST['id_member']]);
            $members = $model->getData('member', [], ['*'], 'ORDER BY id_member');
            $newId = 1;
            foreach ($members as $row) {
                $pdo->prepare("UPDATE member SET id_member = ? WHERE id_member = ?")
                    ->execute([$newId++, $row['id_member']]);
            }
            $pdo->exec("ALTER TABLE member AUTO_INCREMENT = 1");
        }
    }
}

$members = $model->getData('member');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #e3f2fd;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            text-align: center;
            color: #0d47a1;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-control {
            display: flex;
            flex-direction: column;
        }

        .form-control label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #90caf9;
            border-radius: 5px;
            background-color: #e3f2fd;
        }

        .form-control input:focus {
            border-color: #42a5f5;
            outline: none;
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #0d47a1; 
        }

        button:hover {
            background-color: #1565c0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #90caf9;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #42a5f5;
            color: white;
        }

        tbody tr:nth-child(odd) {
            background-color: #e3f2fd;
        }

        tbody tr:nth-child(even) {
            background-color: #bbdefb;
        }

        .delete-button {
            background-color: #0d47a1;
        }

        .delete-button:hover {
            background-color: #1565c0;
        }

        .edit-button {
            background-color: #0d47a1;
        }

        .edit-button:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Member</h1>

        <h2>Tambah/Edit Member</h2>
        <form method="POST">
            <input type="hidden" name="id_member" id="id_member">
            <div class="form-control">
                <label for="nama_member">Nama Member:</label>
                <input type="text" name="nama_member" id="nama_member" required>
            </div>
            <div class="form-control">
                <label for="nomor_member">Nomor Member:</label>
                <input type="text" name="nomor_member" id="nomor_member" required>
            </div>
            <div class="form-control">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div class="form-control">
                <label for="tgl_mendaftar">Tanggal Mendaftar:</label>
                <input type="datetime-local" name="tgl_mendaftar" id="tgl_mendaftar" required>
            </div>
            <div class="form-control">
                <label for="tgl_terakhir_bayar">Tanggal Terakhir Bayar:</label>
                <input type="date" name="tgl_terakhir_bayar" id="tgl_terakhir_bayar" required>
            </div>
            <div class="actions">
                <button type="submit" name="action" value="add">Tambah</button>
                <button type="submit" name="action" value="edit">Simpan Perubahan</button>
            </div>
        </form>

        <h2>Daftar Member</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Member</th>
                    <th>Nama Member</th>
                    <th>Nomor Member</th>
                    <th>Alamat</th>
                    <th>Tanggal Mendaftar</th>
                    <th>Tanggal Terakhir Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?= htmlspecialchars($member['id_member']) ?></td>
                        <td><?= htmlspecialchars($member['nama_member']) ?></td>
                        <td><?= htmlspecialchars($member['nomor_member']) ?></td>
                        <td><?= htmlspecialchars($member['alamat']) ?></td>
                        <td><?= htmlspecialchars($member['tgl_mendaftar']) ?></td>
                        <td><?= htmlspecialchars($member['tgl_terakhir_bayar']) ?></td>
                        <td>
                            <button class="edit-button" onclick="editMember(<?= htmlspecialchars(json_encode($member)) ?>)">Edit</button>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="id_member" value="<?= htmlspecialchars($member['id_member']) ?>">
                                <button type="submit" class="delete-button" name="action" value="delete" onclick="return confirm('Yakin ingin menghapus member ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editMember(member) {
            document.getElementById('id_member').value = member.id_member;
            document.getElementById('nama_member').value = member.nama_member;
            document.getElementById('nomor_member').value = member.nomor_member;
            document.getElementById('alamat').value = member.alamat;
            document.getElementById('tgl_mendaftar').value = member.tgl_mendaftar;
            document.getElementById('tgl_terakhir_bayar').value = member.tgl_terakhir_bayar;
        }

        document.getElementById('tgl_mendaftar').value = new Date().toISOString().slice(0, 16);
    </script>
</body>
</html>