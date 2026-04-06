<?php
require 'db.php';

// 1. Check if the ID exists in the URL
if (isset($_GET['id'])) {
    // 2. Cast the ID to an integer for extra security
    $id = (int)$_GET['id'];

    // 3. Prepare and execute the deletion
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);
}

// 4. Always redirect back to the main page
header("Location: index.php");
exit;
?>