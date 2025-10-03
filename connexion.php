<?php

require_once "src/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_login"] = $user["login"];
            $_SESSION["welcome_message"] = "Bienvenue " . $user["login"] . " !";

            header("Location: profil.php");
            exit();
        }
        else {
            $error = "Login ou mot de passe incorrect";
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
    <title>Connexion</title>
    <link rel="icon" href="assets/icones/tl.ico" type="image/png">
</head>
<body>

<?php require_once "src/header.php"; ?>
<?php require_once "src/navbar.php"; ?>

<main>

    <h2 class="formulaire">Connexion</h2>

        <div class="container mt-5">

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" action="connexion.php">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <div class="input-group">
                <span class="input-group-text">👤</span>
                <input type="text" class="form-control" id="login" name="login" placeholder="Votre login" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
                <span class="input-group-text">🔒</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark" style="margin: 10px;">Connexion</button>
        </div>
    </form>
</div>


</main>


<?php require_once "src/footer.php"; ?>