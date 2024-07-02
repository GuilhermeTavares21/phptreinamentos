<?php

include_once ("header.php");

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
    }
    
include_once ("head.php");
require 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : '';
$data_final = isset($_GET['data_final']) ? $_GET['data_final'] : '';
$sql = 'SELECT * FROM treinamentos WHERE 1=1';
$params = [];

if ($search) {
    $sql .= ' AND (nome_treinamento LIKE ? OR entidade LIKE ? OR tecnico LIKE ?)';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
}

if ($data_inicial) {
    $sql .= ' AND data_inicial >= ?';
    $params[] = $data_inicial;
}

if ($data_final) {
    $sql .= ' AND data_final <= ?';
    $params[] = $data_final;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$treinamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html >
<html data-theme="light">
<head>
    <title>Treinamentos</title>
</head>
<body>
<div class="container mx-auto">
    <div class="flex justify-between my-6">
        <h1 class="text-2xl font-bold">Lista de treinamentos:</h1>
        <a class="btn btn-primary text-white" href="create.php">Cadastrar Treinamento</a>
        
    </div>

    <div class="mb-4">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Pesquisar por nome ou entidade" value="<?php echo htmlspecialchars($search); ?>" class="input input-bordered w-full max-w-xs mr-6">
            <span> De:  </span>
            <input type="date" name="data_inicial" value="<?php echo htmlspecialchars($data_inicial); ?>" class="input input-bordered w-[160px]">
            <span> até </span>
            <input type="date" name="data_final" value="<?php echo htmlspecialchars($data_final); ?>" class="input input-bordered w-[160px] mr-6">
            <button type="submit" class="btn btn-primary text-white"><i class="fa-solid fa-magnifying-glass"></i>Pesquisar</button>
        </form>
    </div>
    <div class="mb-4">
        <button id="btnExport" class="btn btn-success text-white"><i class="fa-solid fa-download"></i>Baixar Tabela</button>
    </div>

    <div class="overflow-x-auto">
        <table id="divTabela" class="table table-zebra">
            <thead>
            <tr class="font-bold text-black">
                <th>ID</th>
                <th>Nome do Treinamento</th>
                <th>Responsável</th>
                <th>Entidade</th>
                <th>Horas</th>
                <th>Data Inicial</th>
                <th>Data Final</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php if(count($treinamentos) > 0): ?>
                <?php foreach ($treinamentos as $treinamento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($treinamento['id']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['nome_treinamento']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['tecnico']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['entidade']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['horas']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['data_inicial']); ?></td>
                            <td><?php echo htmlspecialchars($treinamento['data_final']); ?></td>
                            <td class="flex gap-4">
                                <a class="text-green-600 cursor-pointer" href="update.php?id=<?php echo $treinamento['id']; ?>"><i class="fa-solid fa-pen-to-square"></i>Editar</a>
                                <a class="text-red-600 cursor-pointer" onclick="my_modal_1.showModal()"><i class="fa-solid fa-trash"></i>Deletar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-xl">Não há treinamentos disponíveis.</td>
                    </tr>
                <?php endif; ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>