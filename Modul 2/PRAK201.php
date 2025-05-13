<!DOCTYPE html>
<html lang="en">
<style>
    table {border: solid 1px black;}
    th {font-weight: bold;}
</style>
<body>
    <form action="" method="post">
        nama 1 : <input type="text" name="nama1"><br>
        nama 2 : <input type="text" name="nama2"><br>
        nama 3 : <input type="text" name="nama3"><br>
        <button type="submit" name="Urut">Urutkan</button><br><br>
    </form>
    <table>
        <tr>
            <th>
                Output
            </th>
        </tr>
        <tr>
            <td>
            <?php
                if (isset($_POST['Urut'])){
                    $test1 = $_POST['nama1'];
                    $test2 = $_POST['nama2'];
                    $test3 = $_POST['nama3'];

                    $names = array($test1, $test2, $test3);
                    sort($names);

                    foreach ($names as $name) {
                    echo $name . "<br>";
                    }
                }
            ?>
            </td>
        </tr>
    </table>
</body>