<?php 
require 'db.php'; 

// 1. Sorting Logic
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'ASC';

// Whitelist columns for security
$allowed_columns = ['id', 'title', 'author', 'year_published'];
if (!in_array($sort, $allowed_columns)) { $sort = 'id'; }

// Toggle order for next click
$next_order = ($order === 'ASC') ? 'DESC' : 'ASC';

// 2. Fetch data
$stmt = $pdo->query("SELECT * FROM books ORDER BY $sort $order");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Book Collection</title>
    <link rel="stylesheet" href="style.css?v=1.2">
</head>
<body>
    <div class="container">
        <h2>My Book Collection</h2>
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <a href="add.php" class="btn btn-add">+ Add New Book</a>
            
            <div class="form-group" style="max-width: 300px; margin-bottom: 0;">
                <input type="text" id="searchBar" placeholder="Search by title or author..." autocomplete="off">
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th><a href="index.php?sort=id&order=<?= $next_order ?>">BOOK ID <?= $sort == 'id' ? ($order == 'ASC' ? '↑' : '↓') : '' ?></a></th>
                    <th><a href="index.php?sort=title&order=<?= $next_order ?>">TITLE <?= $sort == 'title' ? ($order == 'ASC' ? '↑' : '↓') : '' ?></a></th>
                    <th><a href="index.php?sort=author&order=<?= $next_order ?>">AUTHOR <?= $sort == 'author' ? ($order == 'ASC' ? '↑' : '↓') : '' ?></a></th>
                    <th><a href="index.php?sort=year_published&order=<?= $next_order ?>">YEAR <?= $sort == 'year_published' ? ($order == 'ASC' ? '↑' : '↓') : '' ?></a></th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            
            <tbody id="tableBody">
                <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $book['id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= (int)$book['year_published'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>" class="edit-link">Edit</a>
                        <a href="delete.php?id=<?= $book['id'] ?>" class="delete-link" 
                           onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    const searchBar = document.getElementById('searchBar');
    const tableBody = document.getElementById('tableBody');

    searchBar.addEventListener('input', function() {
        const query = this.value;

        // Using Fetch API instead of XMLHttpRequest for cleaner code
        fetch('search.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'query=' + encodeURIComponent(query)
        })
        .then(response => response.text())
        .then(data => {
            tableBody.innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
</body>
</html>