<!DOCTYPE html>
<html lang="en">
<head>
    <title>prak 2</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        td,th {
            border: 1px solid black;
            padding: 8px 15px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php
        $data = [
            ["Andi", 2101001, 87, 65],
            ["Budi", 2101002, 76, 79],
            ["Tono", 2101003, 50, 41],
            ["Jessica",2101004, 60, 75]
        ];

        for ($i = 0; $i < count($data); $i++) {
            $uts = $data[$i][2];
            $uas = $data[$i][3];
            $hasil = $uts * 0.4 + $uas * 0.6;
            $data[$i][4] = $hasil;

            if ($hasil >=80){
                $data[$i][5] = "A";
            } else if ($hasil >= 70 && $hasil <= 79){
                $data[$i][5] = "B";
            } else if ($hasil >= 60 && $hasil <= 69){
                $data[$i][5] = "C";
            } else if ($hasil >= 50 && $hasil <= 59){
                $data[$i][5] = "D";
            } else if ($hasil < 50){
                $data[$i][5] = "E";
            }
        }

        echo "<table>";
        echo "<tr style='background-color: #ccc;'>
                <th>Nama</th>
                <th>NIM</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Akhir</th>
                <th>Grade</th>
              </tr>";
        for ($i = 0; $i < count($data); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($data[$i]); $j++) {
                echo "<td>" . htmlspecialchars($data[$i][$j]) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
    ?>
</body>