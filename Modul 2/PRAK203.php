<!DOCTYPE html>
<html lang="en">
<style>
    input[type="radio"] {
        accent-color: blue; 
    }

    .hasil-konversi {
        font-size: 20px;
        font-weight: bold;
    }
</style>
<?php
    function ubahkeCelcius($value, $tem) {
        switch ($tem) {
            case "Fahrenheit":
                return ($value - 32) * 5/9;
            case "Rheamur":
                return $value * 5/4;
            case "Kelvin":
                return $value - 273.15;
            case "Celcius":
            default:
                return $value;
        }
    }

    function ubahdariCelcius($value, $tem) {
        switch ($tem) {
            case "Fahrenheit":
                return ($value * 9/5) + 32;
            case "Rheamur":
                return $value * 4/5;
            case "Kelvin":
                return $value + 273.15;
            case "Celcius":
            default:
                return $value;
        }
    }

    function ubahnamatempraturedariCelcius($tem) {
        switch ($tem) {
            case "Fahrenheit":
                return $tem="F";
            case "Rheamur":
                return $tem="R";
            case "Kelvin":
                return $tem="K";
            case "Celcius":
            default:
                return $tem="C";
        }
    }
?>
<body>
    <form action="" method="post">
        Nilai:
        <input type="text" name="nilai"><br>

        Dari:<br>
        <input type="radio" name="suhusebelum" value="Celcius">Celcius<br>
        <input type="radio" name="suhusebelum" value="Fahrenheit">Fahrenheit<br>
        <input type="radio" name="suhusebelum" value="Rheamur">Rheamur<br>
        <input type="radio" name="suhusebelum" value="Kelvin">Kelvin<br>

        Ke:<br>
        <input type="radio" name="suhusesudah" value="Celcius">Celcius<br>
        <input type="radio" name="suhusesudah" value="Fahrenheit">Fahrenheit<br>
        <input type="radio" name="suhusesudah" value="Rheamur">Rheamur<br>
        <input type="radio" name="suhusesudah" value="Kelvin">Kelvin<br>

        <button type="submit" name="konversi">Konversi</button><br><br>
    </form>

    <?php
        $nilai = "";
        $suhusebelum = "";
        $suhusesudah = "";
        $hasil = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['konversi'])) {
            $nilai = floatval($_POST['nilai']);
            $suhusebelum = $_POST['suhusebelum'];
            $suhusesudah = $_POST['suhusesudah'];

            $hasilcelcius = ubahkeCelcius($nilai, $suhusebelum);

            $hasil = ubahdariCelcius($hasilcelcius, $suhusesudah);

            $namatem = ubahnamatempraturedariCelcius($suhusesudah);
            $hasil = $hasil . " °" . $namatem;

            echo "<div class='hasil-konversi'>Hasil Konversi: $hasil</div>";
        }   
    ?>
</body>
</html>