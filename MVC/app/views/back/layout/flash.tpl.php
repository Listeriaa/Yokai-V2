<div class="alert-JS alert-danger d-none d-flex justify-content-center my-4" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div class="error-text">
        Tous les champs sont obligatoires à l'exception de l'origine
    </div>
</div>




<?php if (isset($_SESSION['infos'])) : ?>
    <div class="container my-4">
        <?php foreach ($_SESSION['infos'] as $error) : ?>
            <div class="alert alert-info">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
        <!-- On nettoie la session après affichage -->
        <?php unset($_SESSION['infos']) ?>
    </div>
<?php endif; ?>