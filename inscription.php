<?php

session_start();

$host = "localhost";
$dbname = "moduleconnexion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = ($_POST["login"]);
    $prenom = ($_POST["prenom"]);
    $nom = ($_POST["nom"]);
    $motDePasse = $_POST["mot_de_passe"];
    $confirmMdp = $_POST["confirm_password"];

    if ($motDePasse !== $confirmMdp) {
        $error = "Les mots de passe ne correspondent pas";
    }
    else {
        
        $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);
        
        $stmt = $pdo -> prepare("INSERT INTO utilisateur (login, prenom, nom, password ) VALUES (?, ?, ?, ?)");

        try {
            $stmt -> execute([$login, $prenom, $nom, $motDePasseHache]);
            header("Location: connexion.php");
            exit();    
        }

        catch (PDOException $e){
            if ($e->getCode() == 23000) {
                $error = "Ce login existe déjà";
            }
            else {
                $error = "Erreur : " . $e->getMessage();
            }
        }
    }
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
</head>
<body>

<header class="bg-dark text-white py-4">
<div class="d-flex justify-content-sm-center"><h1>Bienvenue sur mon site</h1></div>
    

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

    <h2 class="formulaire">Formulaire d'inscription</h2>

    <div class="container mt-5">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="inscription.php">
        <div class="mb-3">
            <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
            <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark" style="margin: 10px;">S'inscrire</button>
        </div>
    </form>
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