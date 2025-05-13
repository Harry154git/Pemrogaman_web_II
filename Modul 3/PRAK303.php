<html lang="en">
<head>
    <title>prak 3</title>
</head>

<body>
    <form action="" method="post">
        Batas Bawah : <input type="text" name="bawah"><br>
        Batas Atas : <input type="text" name="atas"><br>
        <button type="submit" name="cetak">Cetak</button>
    </form>

    <?php
    if (isset($_POST['cetak'])) {
        $bawah = $_POST['bawah'];
        $atas = $_POST['atas'];
        $link = "https://www.freepnglogos.com/uploads/star-png/file-featured-article-star-svg-wikimedia-commons-8.png";
        $i = $bawah;
        do {
            if ((($i + 7) % 5) == 0) {
                echo "<img src='$link' style='width: 20px'> ";
            } else {
                echo "$i ";
            }
            $i++;
        } while ($i <= $atas);
    }
    ?>
</body>