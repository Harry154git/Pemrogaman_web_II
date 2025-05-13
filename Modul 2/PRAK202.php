<!DOCTYPE html>
<html lang="en">
<style>
    .error {
        color: red;
        font-size: 0.9em;
        display: inline-block;
        margin-left: 5px;
    }
    table {border: solid 1px black;}
    th {font-weight: bold;}
</style>

<?php
    $nameerror = $nimerror = $gendererror = "";
    $nama = $nim = $gender = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['nama'])) {
            $nameerror = "* Nama tidak boleh kosong.";
        } else {
            $nama = htmlspecialchars($_POST['nama']);
        }

        if (empty($_POST['nim'])) {
            $nimerror = "* NIM tidak boleh kosong.";
        } else {
            $nim = htmlspecialchars($_POST['nim']);
        }

        if (empty($_POST['gender'])) {
            $gendererror = "* Jenis kelamin harus dipilih.";
        } else {
            $gender = $_POST['gender'];
        }
    }
?>

<body>
    <form action="" method="post">
        Nama:
        <input type="text" name="nama" value="<?= $nama ?>">
        <span class="error"><?= ($_SERVER["REQUEST_METHOD"] == "POST" && $nameerror) ? $nameerror : "*" ?></span><br>

        NIM:
        <input type="text" name="nim" value="<?= $nim ?>">
        <span class="error"><?= ($_SERVER["REQUEST_METHOD"] == "POST" && $nimerror) ? $nimerror : "*" ?></span><br>

        Jenis Kelamin:
        <span class="error"><?= ($_SERVER["REQUEST_METHOD"] == "POST" && $gendererror) ? $gendererror : "*" ?></span><br>
        <input type="radio" name="gender" value="Laki-laki" <?= ($gender == "Laki-laki") ? "checked" : "" ?>>Laki-laki<br>
        <input type="radio" name="gender" value="Perempuan" <?= ($gender == "Perempuan") ? "checked" : "" ?>>Perempuan<br>

        <button type="submit" name="submit">Submit</button>
    </form>
    <table>
        <tr>
            <th>Output :</th>
        </tr>
        <tr>
            <td>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameerror && !$nimerror && !$gendererror) {
                        echo "$nama<br>";
                        echo "$nim<br>";
                        echo "$gender";
                    }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>