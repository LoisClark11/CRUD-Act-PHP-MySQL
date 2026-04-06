<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO books (title, author, year_published) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['title'], 
        $_POST['author'], 
        $_POST['year']
    ]);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Add New Book</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" placeholder="Enter author name" required>
            </div>
            
            <div class="form-group">
                <label for="year">Year Published:</label>
                <input type="number" id="year" name="year" placeholder="Enter publication year" required>
            </div>

            <div class="button-group" style="margin-top: 20px;">
                <button type="submit" class="btn btn-save">Add Book</button>
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>