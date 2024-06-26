<?php
require 'db.php';
include_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['usuario'];
    $password = $_POST['senha'];
    $confirmPassword = $_POST['confirmar-senha'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $error = "Usuário já existe!";
    } else {
        if ($password == $confirmPassword) {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $hashed_password]);

            header('Location: login.php?message=Usuário cadastrado com sucesso!');
            exit();
        } else {
            
            $error = "Senhas não são iguais!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar</title>
</head>
<body>
<div class="flex flex-col justify-center items-center h-[100vh]">
        <form method="POST" class="flex flex-col h-[560px] gap-4 mx-auto w-[400px] rounded-2xl p-10 border shadow-md" action="register.php">
            <h2 class="text-center font-bold text-white text-[30px]">Crie sua conta</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if (isset($_GET['message'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
            <?php endif; ?>
            <p class="text-white">Usuário: </p>
            <label class="input input-bordered flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 16 16"
                fill="currentColor"
                class="h-4 w-4 opacity-70">
                <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
            </svg>
            <input name="usuario" type="text" class="grow" placeholder="Usuário" />
            </label>
            <p class="text-white">Senha: </p>
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
            <input name="senha" type="password" class="grow" value="" />
            </label>
            <p class="text-white">Confirme sua senha: </p>
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
            <input name="confirmar-senha" type="password" class="grow" value="" />
            </label>
            <button class="btn btn-accent" type="submit">Registrar</button>
            <a class="btn btn-warning" href="login.php">Voltar</a>
        </form>
    </div>
</body>
</html>