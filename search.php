<?php
require 'db.php';

// 1. Capture the search query or default to empty
$search = $_POST['query'] ?? '';

// 2. Prepare the SQL using LIKE for partial matches
// We order by id DESC so the newest books show up first in search results
$sql = "SELECT * FROM books WHERE title LIKE ? OR author LIKE ? ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$search%", "%$search%"]);
$books = $stmt->fetchAll();

// 3. Generate the table rows dynamically
if ($books) {
    foreach ($books as $index => $book) {
        // Sanitize data to prevent XSS issues in the live results
        $title = htmlspecialchars($book['title']);
        $author = htmlspecialchars($book['author']);
        $year = (int)$book['year_published'];
        $id = (int)$book['id'];
        $rowNumber = $index + 1;

        echo "<tr>
                <td>{$rowNumber}</td>
                <td>{$id}</td>
                <td>{$title}</td>
                <td>{$author}</td>
                <td>{$year}</td>
                <td>
                    <a href='edit.php?id={$id}' class='edit-link'>Edit</a>
                    <a href='delete.php?id={$id}' class='delete-link' 
                       onclick='return confirm(\"Are you sure you want to delete this book?\");'>Delete</a>
                </td>
              </tr>";
    }
} else {
    // Return a clean "No results" row if nothing matches
    echo "<tr><td colspan='6' style='text-align:center; padding: 20px; color: #666;'>No books found matching your search.</td></tr>";
}
?>