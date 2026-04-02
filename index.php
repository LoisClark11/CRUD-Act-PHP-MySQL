<?php 
require 'db.php'; 
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Book Collection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>My Book Collection</h2>
        <a href="add.php" class="btn btn-add">+ Add New Book</a>
        
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>BOOK ID</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>YEAR</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $book['id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= $book['year_published'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>" class="edit-link">Edit</a>
                        <a href="delete.php?id=<?= $book['id'] ?>" class="delete-link" 
                           onclick="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>