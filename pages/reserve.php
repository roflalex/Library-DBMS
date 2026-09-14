<?php
session_start();
include '../database/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>reserve</title>
</head>
<body>
    <div class="top-bar">
        <p id="title">Reserve Confirmation</p>
        <a href="index.php">← Back</a>
    </div>
</body>
<?php
$un = $_SESSION['username'];
$date = date("Y-m-d");
if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
{
    if (isset($_POST['Reserve']) && isset($_POST['id']))
    {
        $id = $conn->real_escape_string($_POST['id']);

        $sql = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$id'";
        $conn->query($sql);

        $sql2 = "INSERT INTO reservedbooks (ISBN, username, ReservedDate)
                 VALUES ('$id', '$un', '$date')";
        $conn->query($sql2);

        echo 'Success - <a href="reservedlist.php">Continue...</a>';
        return;
    }

    if (isset($_POST['ISBN']))
    {
        $id = $conn->real_escape_string($_POST['ISBN']);

        $sql = "SELECT ISBN, BookTitle FROM books WHERE ISBN = '$id'";
        $result = $conn->query($sql);

        if ($result === false)
        {
            echo 'Query error: ' . htmlspecialchars($conn->error);
            exit;
        }

        $row = $result->fetch_assoc();
        echo "<p>Confirm: Reserving " . htmlspecialchars($row['BookTitle']) . "</p>\n";
        echo '<form method="post">';
        echo '<input type="hidden" name="id" value="' . htmlentities($row["ISBN"]) . '">';
        echo '<input type="submit" value="Reserve" name="Reserve">';
        echo ' <a href="index.php">Cancel</a>';
        echo "</form>\n";
    }
}
else
{
    echo 'Please <a href="login.php">login</a> to use this page';
}

?>
