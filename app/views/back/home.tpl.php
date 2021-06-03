<div class="container my-4">
    <div class="row">
        <div class="col-sm-4 h-100">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Yokais</h5>
                    <p class="card-text">Ajouter, modifier ou supprimer des yokais</p>
                    <?php if(isset($_SESSION['isConnected'])): ?>
                    <a href="<?= $router->generate('yokai-backlist')?>" class="btn btn-custom btn-outline-light">J'y vais!</a>
                    <?php else: ?>
                    <a href="<?= $router->generate('user-login')?>" class="btn btn-danger">Connectez-vous</a>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 h-100">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text">Ajouter, modifier ou supprimer des utilisateurs</p>
                    <?php if(isset($_SESSION['isConnected'])): ?>
                        <?php if ($_SESSION['userObject']->getRole()=='admin') : ?>
                        <a href="<?= $router->generate('user-list')?>" class="btn btn-custom btn-outline-light">J'y vais!</a>
                        <?php else: ?>
                        <a href="#" class="btn btn-warning">droits insuffisants</a>
                        <?php endif; ?>
                    <?php else: ?>
                    <a href="<?= $router->generate('user-login')?>" class="btn btn-danger">Connectez-vous</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 h-100">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Médias</h5>
                    <p class="card-text">Ajouter, modifier ou supprimer des médias</p>
                    <a href="#" class="btn btn-custom disabled" >en construction</a>
                </div>
            </div>
        </div>
    </div>