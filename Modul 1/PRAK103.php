<?php
    $celcius = 37.841;

    $fahrenheit = ((9/5) * $celcius) + 32;
    $reamur = (4/5) * $celcius;
    $kelvin = $celcius + 273.15;

    $fahrenheit_di_format = number_format($fahrenheit, 4, ',', '.');
    $reamur_di_format = number_format($reamur, 4, ',', '.');
    $kelvin_di_format = number_format($kelvin, 4, ',', '.');

    echo "Fahrenheit (F) = $fahrenheit_di_format<br>";
    echo "Reamur (R) = $reamur_di_format<br>";
    echo "Kelvin (K) = $kelvin_di_format";