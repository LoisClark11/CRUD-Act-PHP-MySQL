<?php
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE books SET title=?, author=?, year_published=? WHERE id=?";
    $pdo->prepare($sql)->execute([$_POST['title'], $_POST['author'], $_POST['year'], $id]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Edit Book</h2>
        <form method="POST">
            <div class="form-group">
                <label>Book Title:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="form-group">
                <label>Author:</label>
                <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="form-group">
                <label>Year Published:</label>
                <input type="number" name="year" value="<?= $book['year_published'] ?>" required>
            </div>
            <button type="submit" class="btn btn-save">Update Book</button>
            <a href="index.php" class="btn btn-cancel">Cancel</a>
        </form>
    </div>
</body>
</html>