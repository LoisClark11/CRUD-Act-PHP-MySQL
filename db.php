<?php
$host = 'localhost';
$db   = 'book_collection';
$user = 'root'; 
$pass = '';     
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    // 1. Throw exceptions if there's a SQL error (very helpful for debugging)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    
    // 2. Return data as an associative array (e.g., $book['title'])
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    
    // 3. Use real prepared statements for better security
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // If connection fails, show a clean error message
     die("Database connection failed: " . $e->getMessage());
}
?>