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
    <title>Remove reservation</title>
</head>
<body>
    <div class="top-bar">
        <p id="title">Remove reservation</p>
        <a href="index.php">← Back</a>
    </div>
</body>
<?php
if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
{
    $un = $_SESSION['username'];
    if (isset($_POST['Remove']) && isset($_POST['id']))
    {
        $id = $conn->real_escape_string($_POST['id']);
        $sql = "DELETE FROM reservedbooks WHERE ISBN = '$id' AND username = '$un'";
        $conn->query($sql);
        $sql2 = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$id'";
        $conn->query($sql2);

        echo 'Success - <a href="index.php">Continue...</a>';
        $conn->close();
        return;
    }
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT ISBN,BookTitle FROM books where ISBN = '$id'";
    $result = $conn->query($sql);
    if ($result === false) {
        echo 'Query error: ' . htmlspecialchars($conn->error);
        exit;
    }
    $row = $result->fetch_assoc();
    echo "<p>Confirm: Removing reservation for ". "<strong>". $row['BookTitle'] ."</strong> </p>\n";
    echo ('<form method="post"><input type="hidden"');
    echo('name="id" value ="'.htmlentities($row["ISBN"]).'">'."\n");
    echo('<input type="submit" value="Remove" name="Remove">');
    echo('<a href="index.php">cancel</a>');
    echo("\n</form>\n");
} // end if
else
{
    echo 'Please <a href="login.php">login</a> to use this page';
} // end else
?>
