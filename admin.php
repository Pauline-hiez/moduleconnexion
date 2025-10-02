<?php

require_once "src/db.php";

$stmt = $pdo->query("SELECT id, login, nom, prenom FROM utilisateur");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Admin</title>
    <link rel="icon" href="assets/icones/tl.ico" type="image/png">
</head>
<body>

<?php require_once "src/header.php"; ?>
<?php require_once "src/navbar.php"; ?>

<main>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user["id"]) ?></td>
            <td><?= htmlspecialchars($user["login"]) ?></td>
            <td><?= htmlspecialchars($user["prenom"]) ?></td>
            <td><?= htmlspecialchars($user["nom"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</main>

<?php require_once "src/footer.php"; ?>