<div class="navbar bg-base-100">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">ASI</a>
  </div>
  <div class="flex-none">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a class="btn btn-accent mr-2" href="index.php">Home</a>
        <a class="btn btn-error" href="logout.php">Logout</a>
        <?php else: ?>
        <a class="btn btn-accent" href="login.php">Entrar</a>
        <?php endif; ?>
    </div>
</div>