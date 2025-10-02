<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Accueil</title>
    <link rel="icon" href="assets/icones/tl.ico" type="image/png">
</head>
<body>

<?php require_once "src/header.php"; ?>
<?php require_once "src/navbar.php"; ?>

    
<main>

<h2 class="d-flex justify-content-sm-center">Mon portfolio</h2>

<div class="container text-center my-5">
  
  <div class="row g-4">
    <div class="col-md-4">
      <div class="d-flex flex-column align-items-center">
        <a href="https://github.com/Pauline-hiez/fansite"><img src="assets/img/fansite.png" class="img-fluid custom-img mb-3" alt="Image 1"></a>
        
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex flex-column align-items-center">
        <a href="https://github.com/Pauline-hiez/voyages"><img src="assets/img/voyage.png" class="img-fluid custom-img mb-3" alt="Image 2"></a>
        
      </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex flex-column align-items-center">
        <a href="https://github.com/Pauline-hiez/voyages"><img src="assets/img/caledonie.png" class="img-fluid custom-img mb-3" alt="Image 3"></a>

        </div>
    </div>
    <div class="col-md-4">
      <div class="d-flex flex-column align-items-center">
        <img src="assets/img/plateforme.png" class="img-fluid custom-img mb-3" alt="Image 4">

      </div>
      </div>
    </div>
  </div>

</div>

</main>

<?php require_once "src/footer.php"; ?>
