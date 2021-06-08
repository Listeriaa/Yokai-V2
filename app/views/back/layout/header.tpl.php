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
   


    <title>Back Office</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-custom border-bottom border-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $router->generate('main-home')?>">FrontOffice</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= (isset($type) && $type == 'back office')?'active':''?>" aria-current="page" href="<?= $router->generate('back-home')?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (isset($type) && $type == 'yokai')?'active':''?>" aria-current="page" href="<?= $router->generate('yokai-backlist')?>">Gestion des yokai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (isset($type) && $type == 'user')?'active':''?>" href="<?= $router->generate('user-list')?>">gestion des users</a>
        </li>
        <?php if (isset($_SESSION['isConnected'])) : ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?= $_SESSION['userObject']->getFirstname()?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php if ($_SESSION['userObject']->getRole()=='admin') : ?>
            <li><a class="dropdown-item" href="<?= $router->generate('user-update', ['id'=>$_SESSION['userId']])?>">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            
            <?php endif; ?>

            <li><a class="dropdown-item" href="<?= $router->generate('user-logout')?>">Déconnexion</a></li>
          </ul>
        </li>
        <?php else : ?>
          <li class="nav-item">
          <a class="nav-link " href="<?= $router->generate('user-login')?>">Connexion</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php
include __DIR__.'/flash.tpl.php';
?>

   