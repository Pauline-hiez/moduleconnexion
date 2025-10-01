<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bienvenue</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
        </li>

        <?php if (!isset($_SESSION['user_login'])): ?>
          
          <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>

        <?php else: ?>
          
          <li class="nav-item">
            <a class="nav-link" href="profil.php">Profil</a>
          </li>

          <?php if (isset($_SESSION['user_login']) && $_SESSION['user_login'] === "admin"): ?>
            
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin</a>
            </li>
          <?php endif; ?>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>