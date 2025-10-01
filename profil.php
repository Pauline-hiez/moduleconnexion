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

<?php require_once "src/header.php"; ?>
<?php require_once "src/navbar.php"; ?>

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

<?php require_once "src/header.php"; ?>