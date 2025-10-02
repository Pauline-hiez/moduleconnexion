<?php

require_once "src/db.php";

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
    <title>Inscription</title>
    <link rel="icon" href="assets/icones/tl.ico" type="image/png">
</head>
<body>
    

<?php require_once "src/header.php"; ?>
<?php require_once "src/navbar.php"; ?>

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


<?php require_once "src/footer.php"; ?>
