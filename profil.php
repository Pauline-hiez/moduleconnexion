<?php

session_start();

if (!isset($_SESSION["user_login"])) {
    header("Location: connexion.php");
    exit();
}

$host = "localhost";
$dbname = "moduleconnexion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Erreur de connexion : " . $e -> getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
$stmt->execute([$_SESSION["user_login"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = ($_POST["login"]);
    $prenom = ($_POST["prenom"]);
    $nom = ($_POST["nom"]);

    $stmt = $pdo->prepare("UPDATE utilisateur SET login = ?, prenom = ?, nom = ? WHERE login = ?");
    $stmt->execute([$login, $prenom, $nom, $_SESSION["user_login"]]);

    $success = "Profil modifié ✅️";

    $_SESSION["user_login"] = $login;
    $_SESSION["user_prenom"] = $prenom;
    $_SESSION["user_nom"] = $nom;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Accueil</title>
    <link rel="icon" href="assets/icones/tl.webp" type="image/png">
</head>
<body>

<header class="bg-dark text-white py-4">
<div class="d-flex justify-content-sm-center"><h1>Votre profil</h1></div>
    

</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bienvenue</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inscription.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>

<h2 class="formulaire">Mon profil</h2>

<div class="container mt-5">

    <div class="text-center mt-4">
    <?php if (!empty($_SESSION["welcome_message"])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            🎉 <?= $_SESSION["welcome_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        <?php unset($_SESSION["welcome_message"]); ?>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    </div>

    <form method="post" action="profil.php">
        <div class="mb-3">
            <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" value="<?= htmlspecialchars($user['login']) ?>" required>
        </div>
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark" style="margin: 10px;">Modifier</button>
        </div>
    </form>
    
    
    <div class="text-center mt-4">
        <a href="deconnexion.php" class="btn btn-danger" style="margin: 10px;" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">
            Déconnexion
        </a>
    </div>
</div>

</main>

<footer class="bg-dark text-white py-4">

    <h5 class="d-flex justify-content-start gap-3 ms-3">Nous suivre :</h5>
    <div class="d-flex justify-content-start gap-3 ms-3">
  <a href="https://www.facebook.com" target="_blank">
    <img src="assets/icones/facebook.png" alt="Facebook" class="img-fluid" style="width:30px; height:30px;">
  </a>
  <a href="https://www.twitter.com" target="_blank">
    <img src="assets/icones/twitter.png" alt="Twitter" class="img-fluid" style="width:30px; height:30px;">
  </a>
  <a href="https://www.instagram.com" target="_blank">
    <img src="assets/icones/instagram.png" alt="Instagram" class="img-fluid" style="width:30px; height:30px;">
  </a>
  <a href="https://github.com/Pauline-hiez" target="_blank">
    <img src="assets/icones/github.png" alt="github" class="img-fluid" style="width:30px; height:30px;">
  </a>
</div>

    <div class="mx-auto" style="width: 200px;">
  Copyright © 2025 Pop's.
</div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>