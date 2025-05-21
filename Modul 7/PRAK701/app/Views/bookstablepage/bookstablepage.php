<?php helper('form'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url('/images/image2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Georgia', serif;
            color: #5a442c;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: rgba(245, 240, 225, 0.95);
            border: 1px solid #d1c3a1;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            padding: 24px;
        }

        .form-header {
            background-color: #d9c49b;
            border-bottom: 1px solid #c8b185;
            padding: 12px 16px;
            border-radius: 0;
        }
        
        .form-header h2 {
            margin: 0;
            font-size: 20px;
            color: #5a442c;
        }

        form {
            background-color: #fff;
            border: 1px solid #d1c3a1;
            border-top: none;
            border-radius: 0;
            padding: 20px;
        }

        form label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        form input[type="text"] {
            display: block;
            width: 95%;
            padding: 6px 8px;
            margin-top: 6px;
            border: 1px solid #d1c3a1;
            border-radius: 4px;
            font-size: 14px;
            color: #5a442c;
        }

        form input[type="text"]:focus {
            outline: none;
            border-color: #b59e7f;
            box-shadow: 0 0 3px rgba(181, 158, 127, 0.5);
        }

        .form-actions {
            margin-top: 20px;
        }

        .form-actions button,
        .form-actions a.button-cancel {
            background-color: #d9c49b;
            color: #5a442c;
            border: 1px solid #c8b185;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            margin-right: 8px;
        }

        .form-actions button:hover,
        .form-actions a.button-cancel:hover {
            background-color: #c8b185;
        }

        .form-actions a.button-cancel {
            display: inline-block;
        }

        .table-header {
            margin-top: 40px;
            font-size: 22px;
            font-weight: bold;
            margin-left: 20px;
        }

        .table-wrapper {
            max-height: 130px;
            overflow-y: auto;
            margin-top: 12px;
            border: 1px solid #d1c3a1;
            background-color: #fff;
        }

        .books-table {
            width: 100%;
            border-collapse: collapse;
        }

        .books-table thead tr th,
        .books-table tbody tr td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #c8b185;
        }

        .books-table thead tr th {
            background-color: #e0d2b0;
            color: #5a442c;
            font-weight: bold;
            border-bottom: 1px solid #c8b185;
        }

        .books-table thead tr th:last-child,
        .books-table tbody tr td:last-child {
            border-right: none;
        }

        .books-table tbody tr:last-child td {
            border-bottom: none;
        }

        .books-table tbody tr:nth-child(even) {
            background-color: #faf7ef;
        }

        .action-links a {
            color: #5a442c;
            text-decoration: none;
            font-weight: bold;
            margin-right: 8px;
        }
        .action-links a:hover {
            text-decoration: underline;
        }

        .logout-link {
            position: fixed;
            bottom: 12px;
            right: 16px;
            font-size: 14px;
            color: #5a442c;
            text-decoration: underline;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        .logout-link:hover {
            color: #3e2e1f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2>
                <?= $editMode
                    ? "Edit Buku ID: " . esc($editData['id'])
                    : "Tambah Buku Baru" ?>
            </h2>
        </div>

        <form method="post" action="/books/save">
            <?php if ($editMode): ?>
                <input type="hidden" name="id" value="<?= esc($editData['id']); ?>">
            <?php endif; ?>

            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul"
                   value="<?= old('judul', $editMode ? esc($editData['judul']) : '') ?>">
            <?php if (isset($validation) && $validation->hasError('judul')): ?>
                <small style="color:red;"><?= $validation->getError('judul') ?></small>
            <?php endif; ?>

            <label for="penulis">Penulis:</label>
            <input type="text" id="penulis" name="penulis"
                   value="<?= old('penulis', $editMode ? esc($editData['penulis']) : '') ?>">
            <?php if (isset($validation) && $validation->hasError('penulis')): ?>
                <small style="color:red;"><?= $validation->getError('penulis') ?></small>
            <?php endif; ?>

            <label for="penerbit">Penerbit:</label>
            <input type="text" id="penerbit" name="penerbit"
                   value="<?= old('penerbit', $editMode ? esc($editData['penerbit']) : '') ?>">
            <?php if (isset($validation) && $validation->hasError('penerbit')): ?>
                <small style="color:red;"><?= $validation->getError('penerbit') ?></small>
            <?php endif; ?>

            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="text" id="tahun_terbit" name="tahun_terbit"
                   value="<?= old('tahun_terbit', $editMode ? esc($editData['tahun_terbit']) : '') ?>">
            <?php if (isset($validation) && $validation->hasError('tahun_terbit')): ?>
                <small style="color:red;"><?= $validation->getError('tahun_terbit') ?></small>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit"><?= $editMode ? 'Simpan' : 'Tambah' ?></button>
                <?php if ($editMode): ?>
                    <a href="/books" class="button-cancel">Batal</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="table-header">Daftar Buku</div>

        <div class="table-wrapper">
            <table class="books-table">
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
                    <?php if (!empty($buku)): ?>
                        <?php foreach ($buku as $b): ?>
                        <tr>
                            <td><?= esc($b['id']) ?></td>
                            <td><?= esc($b['judul']) ?></td>
                            <td><?= esc($b['penulis']) ?></td>
                            <td><?= esc($b['penerbit']) ?></td>
                            <td><?= esc($b['tahun_terbit']) ?></td>
                            <td class="action-links">
                                <a href="/books/edit/<?= esc($b['id']) ?>">Edit</a> |
                                <a href="/books/delete/<?= esc($b['id']) ?>"
                                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 20px; color: #7a6b55;">
                                Tidak ada data buku
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="/books/logout" class="logout-link">Logout</a>
</body>
</html>