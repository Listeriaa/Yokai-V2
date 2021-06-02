<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
    <?php
    if (isset($action)) : ?>

        <h2>Modifier <?= $user->getFirstname() ?> <?= $user->getLastname() ?></h2>
    <?php else : ?>
        <h2>Ajouter un utilisateur</h2>
    <?php endif;
    //si les champs obligatoires sont vides, renvoie un message d'alerte
    //si un champ était valide mais pas les autres, la valeur est insérée en value
    //si un champ est invalide, affiche un message d'erreur dans le small
    if (isset($alert)) : ?>
        <h3 class="text-danger"><?= $alert ?></h3>
    <?php endif; ?>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" <?php if (isset($user)) : ?>value="<?= $user->getEmail() ?>" <?php endif; ?> name="email" placeholder="Mail de l'utilisateur">
            <?php if (isset($email) && $email === false) :
            ?>

                <small id="emailHelpBlock" class="form-text text-danger">
                    Merci de renseigner un email
                </small>

            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="password" aria-describedby="passwordHelpBlock">
            <?php if (isset($password) && $password === false) :
            ?>
                <small id="subtitleHelpBlock" class="form-text text-danger">
                    AU moins : 8 caractères / 1 lettre minuscule / 1 lettre majuscule / un chiffre /  et un caractère spécial
                </small>

            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="firstname">Nom de famille</label>
            <input type="text" class="form-control" name="firstname" id="firstname" <?php if (isset($user)) : ?>value="<?= $user->getFirstname() ?>" <?php endif; ?>placeholder="Nom de l'utilisateur" aria-describedby="firstnameHelpBlock">
            <?php if (isset($firstname) && $firstname === false) :
            ?>

                <small id="pictureHelpBlock" class="form-text text-danger">
                    Obligatoire
                </small>

            <?php endif; ?>

        </div>
        <div class="form-group">
            <label for="lastname">Prénom</label>
            <input type="text" class="form-control" name="lastname" <?php if (isset($user)) : ?>value="<?= $user->getLastname() ?>" <?php endif; ?> id="lastname" placeholder="Prénom de l'utilisateur" aria-describedby="lastnameHelpBlock">
            <?php if (isset($lastname) && $lastname === false) :
            ?>

                <small id="homeorderHelpBlock" class="form-text text-danger">
                    Obligatoire
                </small>

            <?php endif; ?>

        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select class="custom-select" id="role" name="role" aria-describedby="roleHelpBlock">
                <option value="">--Choisissez un rôle--</option>
                <option <?php if (isset($user) && $user->getRole() == 'catalog-manager') : ?>selected <?php endif; ?> value="catalog-manager">Catalog-manager</option>
                <option <?php if (isset($user) && $user->getRole() == 'admin') : ?>selected <?php endif; ?> value="admin">Admin</option>


            </select>
            <?php if (isset($role) && $role === false) :
            ?>

                <small id="typeHelpBlock" class="form-text text-danger">
                    obligatoire
                </small>
            <?php else : ?>

                <small id="typeHelpBlock" class="form-text text-muted">
                    Rôle de l'utilisateur (défini les permissions)
                </small>
            <?php endif; ?>

        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock">
                <option value="">--Choisissez un statut--</option>
                <option <?php if (isset($user) && $user->getStatus() == 0) : ?>selected <?php endif; ?> value="0">-</option>
                <option <?php if (isset($user) && $user->getStatus() == 1) : ?>selected <?php endif; ?> value="1">actif</option>
                <option <?php if (isset($user) && $user->getStatus() == 2) : ?>selected <?php endif; ?> value="2">désactivé</option>



            </select>
            <?php if (isset($status) && $status === false) :
            ?>

                <small id="typeHelpBlock" class="form-text text-danger">
                    obligatoire
                </small>
            <?php else : ?>

                <small id="typeHelpBlock" class="form-text text-muted">
                    Statut de l'utilisateur
                </small>
            <?php endif; ?>

        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>