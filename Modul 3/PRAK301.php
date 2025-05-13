<html lang="en">
<head>
    <title>prak 1</title>
</head>

<body>
    <form action="" method="post">
        jumlah peserta: <input type="text" name="peserta"><br>
        <button type="submit" name="cetak">Cetak</button>
    </form>

    <?php
    if (isset($_POST['cetak'])) {
        $jumlah = $_POST['peserta'];
        $i = 1;
        while($i<=$jumlah) {
            $color = ($i % 2 == 1) ? 'red' : 'green';
            echo "<span style='color: $color; font-weight: bold; font-size: 20px'>Peserta ke-$i</span><br><br>";
            $i++;
        }
    }
    ?>
</body>