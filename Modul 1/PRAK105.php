<?php
    $samsung = array("Sam1" => "Samsung Galaxy S22", "Sam2" =>"Samsung Galaxy S22+", "Sam3" =>"Samsung Galaxy A03", "Sam4" =>"Samsung Galaxy Xcover 5");
?>

<!DOCTYPE html>
<html lang="en">
<style>
    table, tr, th, td{border: solid 2px black;}
    th {background-color:rgb(255, 0, 0);
        width: 250px;
        height: 50px;
        font-size: 20px}
</style>
<body>
    <table>
        <tr>
            <th>Daftar Smartphone Samsung</th>
        </tr>
        <tr>
            <td><?=$samsung['Sam1']?></td>
        </tr>
        <tr>
            <td><?=$samsung['Sam2']?></td>
        </tr>
        <tr>
            <td><?=$samsung['Sam3']?></td>
        </tr>
        <tr>
            <td><?=$samsung['Sam4']?></td>
        </tr>
    </table>