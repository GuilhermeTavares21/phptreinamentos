<?php

include_once ("header.php");

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
    }
    
include_once ("head.php");
require 'db.php';
    
$stmt = $pdo->query('SELECT * FROM treinamentos');
$treinamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Treinamentos</title>
</head>
<body>
<div class="container mx-auto">
    <div class="flex justify-between my-6">
        <h1 class="text-white text-2xl font-bold">Lista de treinamentos:</h1>
        <a class="btn btn-primary text-white" href="create.php">Cadastrar Treinamento</a>
    </div>
    <!-- <a class="btn btn-error" href="logout.php">Sair da conta </a> -->
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Treinamento</th>
                <th>Responsável</th>
                <th>Entidade</th>
                <th>Horas</th>
                <th>Data do Treinamento</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($treinamentos as $treinamento): ?>
                <tr>
                    <td><?php echo htmlspecialchars($treinamento['id']); ?></td>
                    <td><?php echo htmlspecialchars($treinamento['nome_treinamento']); ?></td>
                    <td><?php echo htmlspecialchars($treinamento['tecnico']); ?></td>
                    <td><?php echo htmlspecialchars($treinamento['entidade']); ?></td>
                    <td><?php echo htmlspecialchars($treinamento['horas']); ?></td>
                    <td><?php echo htmlspecialchars($treinamento['data_treinamento']); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $treinamento['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a onclick="my_modal_1.showModal()"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Deletar</h3>
    <p class="py-4">Tem certeza que deseja cancelar este treinamento? </p>
    <div class="modal-action">
      <form method="dialog">
          <button class="btn btn-error">Cancelar</button>
          <a class="btn btn-accent" href="delete.php?id=<?php echo $treinamento['id']; ?>">Deletar</a>
      </form>
    </div>
  </div>
</dialog>
</body>
</html>