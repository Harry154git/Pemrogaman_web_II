<!DOCTYPE html>
<html lang="en">
<style>
    .hasil {
        font-size: 20px;
        font-weight: bold;
    }
</style>
<?php
    function ubahkeejaan($nilai) {
        if ($nilai == 0) {
            return "Nol";
        } else if ($nilai >= 1 && $nilai < 10) {
            return "Satuan";
        } else if ($nilai >= 10 && $nilai < 100) {
            return "Belasan";
        } else if ($nilai >= 100 && $nilai < 1000) {
            return "Ratusan";
        } else if ($nilai >= 1000) {
            return "Anda Menginput Melebihi Limit Bilangan";
        } else {
            return "Salah Input";
        }
    }
?>
<body>
    <form action="" method="post">
        Nilai:
        <input type="text" name="nilai"><br>
        <button type="submit" name="konversi">Konversi</button><br><br>
    </form>

    <?php
        $nilai = "";
        $hasil = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['konversi'])) {
            $nilai = $_POST['nilai'];

            $hasil = ubahkeejaan($nilai);

            echo "<div class='hasil'>Hasil : $hasil</div>";
        }   
    ?>
</body>
</html>