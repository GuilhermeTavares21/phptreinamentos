<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$token = bin2hex(random_bytes(2)); 

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('INSERT INTO tokens (user_id, token) VALUES (?, ?)');
    $stmt->execute([$user_id, $token]);

    $pdo->commit();

    header("Location: generate_token.php?token=$token");
    exit();
} catch (PDOException $e) {
    $pdo->rollBack();
    echo 'Erro: ' . $e->getMessage();
    exit();
}

?>