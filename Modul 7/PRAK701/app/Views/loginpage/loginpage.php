<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: url("<?= base_url('images/image1.jpg') ?>") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .flash-error {
            position: absolute;
            top: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .flash-box {
            background-color: rgba(255, 100, 100, 0.9);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
            max-width: 400px;
            text-align: center;
            font-weight: bold;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #222;
            color: #c79b3d; 
            border: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #444;
        }
    </style>
</head>
<body>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash-error">
            <div class="flash-box">
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="login-container">
        <h2 style="font-family: 'Roboto Condensed', sans-serif;">Login</h2>

        <form action="<?= base_url('/login') ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>">
                <?php if (session()->getFlashdata('validationErrors')['username'] ?? false): ?>
                    <div class="error-message"><?= session()->getFlashdata('validationErrors')['username'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <?php if (session()->getFlashdata('validationErrors')['password'] ?? false): ?>
                    <div class="error-message"><?= session()->getFlashdata('validationErrors')['password'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit">Log in</button>
        </form>
    </div>
</body>
</html>