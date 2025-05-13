<?php
    $jari_jari = 4.2;
    $tinggi = 5.4;
    $panjang = 8.9;
    $lebar = 14.7;
    $Sisi = 7.9;

    $volume_tabung = 3.14 * $jari_jari * $jari_jari * $tinggi;

    $volume_tabung_di_format = number_format($volume_tabung, 3, ',', '.');
    
    echo "$volume_tabung_di_format m3<br>";