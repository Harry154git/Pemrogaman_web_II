<?php
    $samsung = array("Samsung Galaxy S22", "Samsung Galaxy S22+", "Samsung Galaxy A03", "Samsung Galaxy Xcover 5");
?>

<!DOCTYPE html>
<html lang="en">
<style>
    table, tr, th, td{border: solid 1px black;}
</style>
<body>
    <table>
        <tr>
            <th>Daftar Smartphone Samsung</th>
        </tr>
        <?php
        foreach ($samsung as $item) :
        ?>
            <tr>
                <td><?=$item; ?></td>
            </tr>
        <?php endforeach ?>
    </table>