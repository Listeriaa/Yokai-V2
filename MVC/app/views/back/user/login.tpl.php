<div class="container my-4">
    <!-- 
        On utilise le composant Alert de Bootstrap 
        pour afficher nos erreurs s'il y en a
    -->
    <?php if(isset($error)): ?>
        
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div
    <?php endif; ?>

    <h2 class="text-center">Connexion</h2>
    <form method="POST">
    <input type="hidden" name="token" value="<?= $token; ?>" />

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Entrez votre email">
            <small id="emailHelp" class="form-text text-muted">Nous respectons votre vie privée.</small>
        </div>
        <div class="form-group my-4">
            <label for="inputPassword">Mot de passe</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Entrez votre mot de passe">
        </div>
        <button type="submit" class="btn btn-custom my-4">Valider</button>
    </form