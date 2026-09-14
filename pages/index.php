<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="top-bar">
            <p id="title">Library Reservations</p>
            <div class ="actions">
                <?php if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1):?>
                    <a href="reservedlist.php">View reserved books</a><br>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <button type="button" class="logButton" id="lb">Login</button>
                    <button type="button" class="regButton" id="rb">Register</button>                
                <?php endif;?>
            </div>      
    </div>
    
    <main>
        <div class="container">
            <?php if (!empty($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1): ?>
                <p>You are logged in</p>
                <form method="get" action="search.php">
                    <label>Search for a book</label><br>
                    <input type="search" name="book" />
                    
                    <select name="search_type">
                        <option value="title_author" selected>Search by Title/Author</option>
                        <option value="category">Search by Category</option>
                    </select>
                    
                    <button type="submit">Search</button>
                </form>
                <?php else: ?>
                    <p> Please login to search and reserve a book</p>
                <?php endif; ?>

            
        </div>
    </main>

    <script src="../scripts/script.js"></script>

</body>
</html>