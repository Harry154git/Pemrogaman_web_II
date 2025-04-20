<html lang="en">
<head>
    <title>prak 5</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="input">
        <button type="submit" name="submit">submit</button>
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $input = $_POST['input'];
            
            $length = strlen($input);

            $output = "";

        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];
            $output .= strtoupper($char) . str_repeat(strtolower($char), $length - 1);
        }
            echo "$output";
        }
    ?>
</body>
</html>