<html lang="en">
<head>
    <title>prak 4</title>
</head>

<body>
    <form action="" method="post">
        <?php
            $link = "https://www.freepnglogos.com/uploads/star-png/file-featured-article-star-svg-wikimedia-commons-8.png";
            $gambarbintang = [];

            if (isset($_POST['data'])) {
                $gambarbintang = explode(',', $_POST['data']);
            }

            if (isset($_POST['submit'])) {
                $jumlah = $_POST['jumlah'];
                $i = 1;
                $gambarbintang = array();
    
                while ($i <= $jumlah) {
                    $gambarbintang[] = $link;
                    $i++;
                }
            }
    
            if (isset($_POST['tambah'])) {
                array_push($gambarbintang, $link);
            }
    
            if (isset($_POST['kurang'])) {
                array_pop($gambarbintang);
            }

            if (!empty($gambarbintang)) {
                echo 'Jumlah bintang: ' . count($gambarbintang) . '<br><br><br>';
            } else {
                echo 'Jumlah bintang <input type="text" name="jumlah"><br>';
                echo '<button type="submit" name="submit">Submit</button>';
            }
    
            if (!empty($gambarbintang)) {
                $i = 0;
                while ($i < count($gambarbintang)) {
                    echo "<img src='" . $gambarbintang[$i] . "' width='70' height='70'>";
                    $i++;
                }
            }
    
            if (!empty($gambarbintang)) {
                echo '<br>';
                echo '<button type="submit" name="tambah">Tambah</button>';
                echo '<button type="submit" name="kurang">Kurang</button>';
            }

            if (!empty($gambarbintang)) {
                echo '<input type="hidden" name="data" value="' . implode(',', $gambarbintang) . '">';
            }
        ?>
    </form>
</body>