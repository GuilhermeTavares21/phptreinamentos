<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM treinamentos WHERE id = ?');
$stmt->execute([$id]);

header('Location: index.php');
exit;
?>