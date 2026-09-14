<?php
        include '../database/db_connect.php';
        session_start();
        $url = 'http://localhost/library/pages/index.php';
        if ( isset($_POST['username'])&& isset($_POST['password'])) 
        {
            $un = $_POST['username'];
            $p = $_POST['password'];

            $sql = "SELECT * FROM users WHERE username = '$un' and password = '$p' ";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) 
            { 
                $row = $result->fetch_assoc();
                if ($row['password'] === $p) 
                {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['loggedIn'] = 1;
                    header('Location: '.$url);
                    die();
                }
            }
            else 
            {
                echo "Login Error. Wrong username, password or email"; 
            }
            $conn->close(); 
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Login</title>
    </head>
    <body>
        <div class="top-bar">
            <p id="title">Login Page</p>
            <a href="index.php">← Back</a>
        </div>

        <div class="lForm">
            <form method="POST" action="">
                <div class="form-grid">

                    <div class="input-wrapper">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" minlength="6" required>
                    </div>
                </div>

                <button type="submit" class="logButton">Login</button>
            </form>
        </div>
    </body>
    </html>