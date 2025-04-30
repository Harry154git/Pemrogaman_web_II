<!DOCTYPE html>
<html lang="en">
<head>
    <title>prak 1</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        td {
            border: 1px solid black;
            width: 30px;
            height: 30px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        Panjang : <input type="text" name="panjang" value="<?php if (isset($_POST['panjang'])) echo htmlspecialchars($_POST['panjang']); ?>"><br>
        Lebar : <input type="text" name="lebar" value="<?php if (isset($_POST['lebar'])) echo htmlspecialchars($_POST['lebar']); ?>"><br>
        Nilai : <input type="text" name="nilai" value="<?php if (isset($_POST['nilai'])) echo htmlspecialchars($_POST['nilai']); ?>"><br>
        <button type="submit" name="cetak">Cetak</button>
    </form>

    <?php
    if (isset($_POST['cetak'])) {
        $panjang = $_POST['panjang'];
        $lebar = $_POST['lebar'];
        $nilai = $_POST['nilai'];
        $nilai = explode(separator: ' ',string:$nilai);
        $nilai = array_map('trim', $nilai);
        if($panjang * $lebar >= count($nilai)) {
            echo "<table>";
            $index = 0;
            for ($i = 0; $i < $panjang; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $lebar; $j++) {
                    $data = isset($nilai[$index]) ? htmlspecialchars($nilai[$index]) : '';
                    echo "<td>" . $data . "</td>";
                    $index++;
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Panjang nilai tidak sesuai dengan ukuran matriks";
            exit;
        }
        
    }
    ?>
</body>