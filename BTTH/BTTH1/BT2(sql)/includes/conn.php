<?php
$dsn = 'mysql:host=localhost;dbname=quiz';
$username = 'root';
$password = '123456';

try {
    $conn = new PDO($dsn, $username, $password);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
