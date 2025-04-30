<!DOCTYPE html>
<html lang="en">
<head>
    <title>prak 3</title>
</head>

<body>
    <?php
        $data = [
            "Ridho" => [
                ["Pemrograman I", 2],
                ["Praktikum Pemrograman I", 1],
                ["Pengantar Lingkungan Lahan Basah", 2],
                ["Arsitektur Komputer", 3]
            ],
            "Ratna" => [
                ["Basis Data I", 2],
                ["Praktikum Basis Data I", 1],
                ["Kalkulus", 3]
            ],
            "Tono" => [
                ["Rekayasa Perangkat Lunak", 3],
                ["Analisis dan Perancangan Sistem", 3],
                ["Komputasi Awan", 3],
                ["Kecerdasan Binis", 3]
            ]
        ];

        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr style='background-color: #ccc;'>
            <th>No</th>
            <th>Nama</th>
            <th>Mata Kuliah diambil</th>
            <th>SKS</th>
            <th>Total SKS</th>
            <th>Keterangan</th>
        </tr>";
        
        $nama_nama = array_keys($data);

        for ($i = 0; $i < count($nama_nama); $i++) {
            $nama = $nama_nama[$i];
            $sks = 0;
            for ($j = 0; $j < count($data[$nama]); $j++) {
                $sks = $sks + $data[$nama][$j][1];
            }

            if ($sks >= 8) {
                $keterangan = "Tidak Revisi";
                $warna = "green";
            } else {
                $keterangan = "Revisi KRS";
                $warna = "red";
            }

            $data[$nama][0][2] = $sks;
            $data[$nama][0][3] = $keterangan;

            for ($j = 0; $j < count($data[$nama]); $j++) {
                echo "<tr>";
                
                if ($j == 0) {
                    echo "<td>" . ($i + 1) . "</td>"; 
                    echo "<td>$nama</td>"; 
                } else {
                    echo "<td></td><td></td>";
                }
    
                echo "<td>" . $data[$nama][$j][0] . "</td>"; 
                echo "<td>" . $data[$nama][$j][1] . "</td>"; 
    
                if ($j == 0) {
                    echo "<td>$sks</td>"; 
                    echo "<td style='background-color:$warna;color:black;'>$keterangan</td>";
                } else {
                    echo "<td></td><td></td>";
                }
    
                echo "</tr>";

            }

        }

        echo "</table>";

    ?>
</body>