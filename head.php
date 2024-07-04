<?php
  include_once 'header.php';
?>
<div data-theme="light" class="navbar shadow-md">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl"><img class="logo" src="img/asi-logo.png"></a>
  </div>
  <div class="flex-none">
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn m-1"><i class="fa-solid fa-bars"></i></div>
          <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
            <li><a class="" href="generate_token.php"><i class="fa-solid fa-key"></i></i>Gerar Token</a></li>
            <li><a class="" href="index.php"><i class="fa-solid fa-house-user"></i>Home</a></li>
            <li><a class="" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
        </div>
        <div class="navmenu">
          <a class="btn btn-accent mr-2" href="generate_token.php"><i class="fa-solid fa-key"></i></i>Gerar Token</a>
          <a class="btn btn-accent mr-2" href="index.php"><i class="fa-solid fa-house-user"></i>Home</a>
          <a class="btn btn-error" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
        <?php else: ?>
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button" class="btn m-1"><i class="fa-solid fa-bars"></i></div>
          <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
            <li><a class="" href="register.php"><i class="fa-regular fa-address-card"></i>Registrar</a></li>
            <li><a class="" href="login.php"><i class="fa-solid fa-user"></i>Entrar</a></li>
          </ul>
        </div>
        <div class="navmenu">
          <a class="btn btn-warning" href="register.php">Registrar</a>
          <a class="btn btn-accent ml-3" href="login.php">Entrar</a>
        </div>
        <?php endif; ?>
    </div>
</div>