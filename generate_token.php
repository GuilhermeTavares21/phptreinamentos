<?php
session_start();
include_once 'header.php';
include_once 'head.php';
;
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$token = isset($_GET['token']) ? $_GET['token'] : '';
?>

<!DOCTYPE html>
<html data-theme="light">
<head>
    <title>Gerar Token</title>
</head>
<body>
<div class="card mx-auto mt-[5%] border rounded-md bg-gray-100 w-96 shadow-xl">
    <h2 class="card-title p-4">Gerar Token!</h2>
  <figure class="h-[200px]">
    <h2>
        <?php if ($token): ?>
        <h1 class="text-center mr-[10px]">Token gerado:</h1> </br>
        <p class="border bg-white rounded-md p-4"><?php echo htmlspecialchars($token); ?></p>
        <?php endif; ?>
    </h2>
  </figure>
  <div class="card-body">
    <p>O Token irá expirar depois de 30 segundos.</p>
    <div class="card-actions justify-end">
        <form class="flex w-full justify-between mt-5" method="POST" action="process_token.php">
            <a class="btn btn-warning" href="index.php"> Voltar </a>
            <button type="submit" class="btn btn-primary">Gerar</button>
        </form>
    </div>
  </div>
</div>
</body>
</html>