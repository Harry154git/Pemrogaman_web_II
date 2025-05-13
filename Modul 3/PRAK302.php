<html lang="en">
<head>
    <title>prak 2</title>
</head>

<body>
    <form action="" method="post">
        Tinggi : <input type="text" name="tinggi"><br>
        Alamat gambar : <input type="text" name="link"><br>
        <button type="submit" name="cetak">Cetak</button>
    </form>

    <?php
    if (isset($_POST['cetak'])) {
        $tinggi = $_POST['tinggi'];
        $link = $_POST['link'];
        $i = 1;
        while($i<=$tinggi) {
            for ($j = 1; $j < $i; $j++) {
                echo "<span style='display:inline-block; width:100px; margin: 5px'></span>";
            }

            for($j=1;$j<=$tinggi-$i+1; $j++){
                echo "<img src='$link' style='width: 100px; margin: 5px'>";
            }
            echo"<br>";
            $i++;
        }
    }
    ?>
</body>