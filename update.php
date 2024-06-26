<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM treinamentos WHERE id = ?');
$stmt->execute([$id]);
$treinamento = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_treinamento = $_POST['nome_treinamento'];
    $entidade = $_POST['entidade'];
    $data_treinamento = $_POST['data_treinamento'];

    $stmt = $pdo->prepare('UPDATE treinamentos SET nome_treinamento = ?, entidade = ?, data_treinamento = ? WHERE id = ?');
    $stmt->execute([$nome_treinamento, $entidade, $data_treinamento, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Treinamento</title>
</head>
<body>
    <h1>Editar Treinamento</h1>
    <form method="POST" action="update.php?id=<?php echo $id; ?>">
        <label for="nome_treinamento">Nome do Treinamento:</label>
        <input type="text" id="nome_treinamento" name="nome_treinamento" value="<?php echo htmlspecialchars($treinamento['nome_treinamento']); ?>" required>
        <br>
        <label for="entidade">Entidade:</label>
        <input type="text" id="entidade" name="entidade" value="<?php echo htmlspecialchars($treinamento['entidade']); ?>" required>
        <br>
        <label for="data_treinamento">Data do Treinamento:</label>
        <input type="date" id="data_treinamento" name="data_treinamento" value="<?php echo htmlspecialchars($treinamento['data_treinamento']); ?>" required>
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>