<?php
require 'db.php';

// 1. Get and validate the ID immediately
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Fetch the current book data
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

// 3. If book doesn't exist, send them back to the list
if (!$book) {
    header("Location: index.php");
    exit;
}

// 4. Handle the Update request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE books SET title=?, author=?, year_published=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['title'], 
        $_POST['author'], 
        $_POST['year'], 
        $id
    ]);
    
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css?v=1">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Edit Book</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="year">Year Published:</label>
                <input type="number" id="year" name="year" value="<?= (int)$book['year_published'] ?>" required>
            </div>

            <div class="button-group" style="margin-top: 20px;">
                <button type="submit" class="btn btn-save">Update Book</button>
                <a href="index.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>