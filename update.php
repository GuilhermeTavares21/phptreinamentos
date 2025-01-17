<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';
include_once 'header.php';
include_once 'head.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM treinamentos WHERE id = ?');
$stmt->execute([$id]);
$treinamento = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_treinamento = $_POST['nome_treinamento'];
    $entidade = $_POST['entidade'];
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];
    $horas = $_POST['horas'];
    $responsavel = $_POST['responsavel'];

    $stmt = $pdo->prepare('UPDATE treinamentos SET nome_treinamento = ?, entidade = ?, data_inicial = ?, data_final = ?, horas = ?, tecnico = ? WHERE id = ?');
    $stmt->execute([$nome_treinamento, $entidade, $data_inicial, $data_final, $horas, $responsavel, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html data-theme="light">
<head>
    <title>Editar Treinamento</title>
</head>
<body>
<div class="flex flex-col justify-center items-center h-auto">
        <form method="POST" action="update.php?id=<?php echo $id; ?>" class="flex flex-col h-[800px] gap-4 mx-auto w-[50%] min-w-[350px] max-w-[490px] rounded-2xl p-10 border shadow-md">
            <h2 class="text-center font-bold  text-[30px]">Editar treinamento: </h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['message'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
            <?php endif; ?>
            <p class="">Conteudo: </p>
            <label class="input input-bordered flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70">
                <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
            </svg>
            <input name="nome_treinamento" type="text" class="grow" placeholder="Conteudo" value="<?php echo htmlspecialchars($treinamento['nome_treinamento']); ?>" />
            </label>
            <p class="">Responsável: </p>
            <label class="input input-bordered flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70">
                <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
            </svg>
            <input name="responsavel" type="text" class="grow" placeholder="Responsável" value="<?php echo htmlspecialchars($treinamento['tecnico']); ?>" />
            </label>
            <p class="">Entidade: </p>
            <label class="input input-bordered flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70">
                <path
                fill-rule="evenodd"
                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                clip-rule="evenodd" />
            </svg>
            <input name="entidade" type="text" class="grow" placeholder="Entidade" value="<?php echo htmlspecialchars($treinamento['entidade']); ?>"/>
            </label>
            <p class="">Horas: </p>
            <label class="input input-bordered flex items-center gap-2">
            <input name="horas" type="text" class="grow" placeholder="Horas" value="<?php echo htmlspecialchars($treinamento['horas']); ?>"/>
            </label>
            <p class="">Data Inicial: </p>
            <label class="input input-bordered flex items-center gap-2">
            <input name="data_inicial" type="date" class="grow" value="<?php echo htmlspecialchars($treinamento['data_inicial']); ?>" />
            </label>
            </label>
            <p class="">Data Final: </p>
            <label class="input input-bordered flex items-center gap-2">
            <input name="data_final" type="date" class="grow" value="<?php echo htmlspecialchars($treinamento['data_final']); ?>" />
            </label>
            <div class="flex justify-between">
                <a class="btn btn-warning w-[30%]" href="index.php">Voltar</a>
                <button class="btn btn-accent w-[30%]" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>

</body>
</html>