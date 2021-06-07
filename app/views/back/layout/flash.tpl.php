<?php if (isset($_SESSION['infos'])) : ?>
    <div class="container my-4">
        <?php foreach ($_SESSION['infos'] as $info) : ?>
            <div class="alert <?= ($currentPage == 'back/user/login')?'alert-danger':'alert-info';?>">
                <?= $info ?>
            </div>
        <?php endforeach; ?>
        <!-- On nettoie la session après affichage -->
        <?php unset($_SESSION['infos']) ?>
    </div>
<?php endif; ?>