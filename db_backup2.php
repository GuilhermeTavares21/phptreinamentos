<?php
$host = 'sql113.infinityfree.com';
$dbname = 'if0_36796057_treinamentos_db';
$username = 'if0_36796057';
$port = 3306;
$password = 'treinamentos123';


try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>