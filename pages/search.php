<?php
include '../database/db_connect.php';
session_start();

$q = '';
$searchType = 'title_author'; 
if (!empty($_GET['book'])) {
    $q = trim($_GET['book']);
}
if (!empty($_GET['search_type'])) {
    $searchType = $_GET['search_type'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="top-bar">
        <p id="title">Search Results</p>
        <a href="index.php"><- Back</a>
    </div>
    <form method="get" action="search.php">
        <input type="search" name="book" value="<?php echo htmlentities($q); ?>" placeholder="Search..." />
        
        <select name="search_type">
            <option value="title_author" <?php echo ($searchType === 'title_author') ? 'selected' : ''; ?>>Search by Title/Author</option>
            <option value="category" <?php echo ($searchType === 'category') ? 'selected' : ''; ?>>Search by Category</option>
        </select>
        <button type="submit">Search</button>
    </form>

<?php
if ($q === '') 
{
    echo "<p>Enter a search term to find books.</p>";
    exit;
}

$like = '%' . $conn->real_escape_string($q) . '%';

if ($searchType === 'category') 
{
    $sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, b.CategoryID, b.Reserved 
            FROM books b
            INNER JOIN categories c ON b.CategoryID = c.CategoryID
            WHERE c.Description LIKE '$like'
            LIMIT 200";
} 
else 
{
    $sql = "SELECT ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserved 
            FROM books 
            WHERE BookTitle LIKE '$like' 
               OR Author LIKE '$like'
            LIMIT 200";
}

$result = $conn->query($sql);

if (!$result) {
    echo "<p>Search error.</p>";
    $conn->close();
    exit;
}

if ($result->num_rows === 0) {
    echo "<p>No books found for '<strong>" . htmlspecialchars($q) . "</strong>'.</p>";
    $conn->close();
    exit;
}

// results table
echo '<table border="1" cellpadding="6" cellspacing="0">';
echo '<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Category</th><th>Status</th></tr>';

while ($row = $result->fetch_assoc()) {
    $isbn = htmlentities($row['ISBN']);
    $title = htmlentities($row['BookTitle']);
    $author = htmlentities($row['Author']);
    $edition = htmlentities($row['Edition']);
    $year = htmlentities($row['Year']);
    $cat = htmlentities($row['CategoryID']);
    $reserved = htmlentities(($row['Reserved']));

    echo "<tr>";
    echo "<td>$isbn</td>";
    echo "<td>$title</td>";
    echo "<td>$author</td>";
    echo "<td>$edition</td>";
    echo "<td>$year</td>";
    echo "<td>$cat</td>";
    echo '<td>';
    if ($reserved === 'N') 
    {
        echo '<form method="post" action="reserve.php" style="margin:0;">';
        echo '<input type="hidden" name="ISBN" value="' . $isbn . '">';
        echo '<input type="hidden" name="return_query" value="' . htmlentities($q) . '">';
        if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1) 
        {
            echo '<button type="submit">Reserve</button>';
        } 
        else 
        {
            echo '<span>Login to reserve</span>';
        }
        echo '</form>';
    } 
    else 
    {
        echo 'Reserved';
    }
    echo '</td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
</body>
</html>