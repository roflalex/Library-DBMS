<?php
include '../database/db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>list of reserved books</title>
</head>
<body>
    <div class="top-bar">
        <p id="title">Reserved list</p>
        <a href="index.php">← Back</a>
    </div>
</body>
<?php
if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
{
    $un = $_SESSION['username'];
    $sql = "SELECT r.ISBN, b.BookTitle, r.ReservedDate FROM reservedbooks r JOIN books b ON b.ISBN = r.ISBN WHERE r.username = '$un'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        echo $un. ' reserved books';
        echo "<table border ='1'>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr><td>";
            echo(htmlentities($row["ISBN"]));
            echo("</td><td>");
            echo(htmlentities($row["BookTitle"]));
            echo("</td><td>");
            echo(htmlentities($row["ReservedDate"]));
            echo("</td><td>");
            echo('<a href="delete.php?id='.htmlentities($row["ISBN"]).'">Remove reservation</a>');
            echo("</td></tr>\n");
        }
    }
    else
    {
        echo "0 books reserved. Find a book to reserve <a href=search.php>Here</a>";
    }
}
else
{
    echo 'Please <a href="login.php">login</a> to use this page';
}
?>
