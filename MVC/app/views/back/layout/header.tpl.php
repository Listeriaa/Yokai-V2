<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$assetsBaseUri?>css/backstyle.css">
    <link rel="stylesheet" href="<?=$assetsBaseUri?>css/fontawesome/css/all.css">
    <script defer src="<?=$assetsBaseUri?>js/form.js"></script>


    <title>Back Office</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom border-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $router->generate('back-main')?>">BackOffice</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $router->generate('back-yokailist')?>">Gestion des yokai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">gestion des users</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Prénom de l'utilisateur
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Profil</a></li>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Déconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
include __DIR__.'/flash.tpl.php';
?>

   