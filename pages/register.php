<?php
    include '../database/db_connect.php';
    $url = "http://localhost/library/pages/login.php";

    if ( isset($_POST['username']) && isset($_POST['fName']) && isset($_POST['sName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pnumber'])) 
    {
        $un = $_POST['username'];
        $fn = $_POST['fName'];
        $sn = $_POST['sName'];
        $e = $_POST['email'];
        $p = $_POST['password'];
        $pn = $_POST['pnumber'];

        $sql = "INSERT INTO users (username, fName, sName, email,password,pnumber) VALUES ('$un','$fn','$sn', '$e', '$p','$pn')";
        if ($conn->query($sql) === TRUE) 
        { 
            echo "Register Successful";
            header('Location: '.$url);
            die();
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
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
    <title>Registration</title>
</head>
<body>
    <div class="top-bar">
        <p id="title">Registration Page</p>
        <a href="index.php">← Back</a>

    </div>

    <div class="rForm">
        <form method="POST" action="">
            <div class="form-grid">
                <div class="input-wrapper">
                    <label for="fName">First Name</label>
                    <input type="text" id="fName" name="fName" required>
                </div>

                <div class="input-wrapper">
                    <label for="sName">Surname</label>
                    <input type="text" id="sName" name="sName" required>
                </div>

                <div class="input-wrapper">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="input-wrapper">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-wrapper">
                    <label for="password">Password</label>
                    <small> Minimum 6 characters required </small>
                    <input type="password" id="password" name="password" minlength="6" required>
                </div>

                <div class="input-wrapper">
                    <label for="pnumber">Phone Number</label>
                    <small> Format: 999-999-9999</small>
                    <input type="tel" id="pnumber" name="pnumber" 
                           pattern="[0-9]{3}-[0-9]{w}-[0-9]{4}" required>
                </div>
            </div>

            <button type="submit" class="regButton">Register</button>
        </form>
    </div>
</body>
</html>