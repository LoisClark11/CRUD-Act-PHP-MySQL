<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO books (title, author, year_published) VALUES (?, ?, ?)";
    $pdo->prepare($sql)->execute([$_POST['title'], $_POST['author'], $_POST['year']]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Add New Book</h2>
        <form method="POST">
            <div class="form-group">
                <label>Book Title:</label>
                <input type="text" name="title" placeholder="Enter book title" required>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <input type="text" name="author" placeholder="Enter author name" required>
            </div>
            <div class="form-group">
                <label>Year Published:</label>
                <input type="number" name="year" placeholder="Enter publication year" required>
            </div>
            <button type="submit" class="btn btn-save">Add Book</button>
            <a href="index.php" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>