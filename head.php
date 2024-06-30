<?php
  include_once 'header.php';
?>
<div class="navbar shadow-md">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl"><img class="logo" src="img/asi-logo.png"></a>
  </div>
  <div class="flex-none">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a class="btn btn-accent mr-2" href="generate_token.php"><i class="fa-solid fa-key"></i></i>Gerar Token</a>
        <a class="btn btn-accent mr-2" href="index.php"><i class="fa-solid fa-house-user"></i>Home</a>
        <a class="btn btn-error" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        <?php else: ?>
        <a class="btn btn-warning" href="register.php">Registrar</a>
        <a class="btn btn-accent ml-3" href="login.php">Entrar</a>
        <?php endif; ?>
    </div>
</div>