
<div class="container my-4">
    <h1 class="text-center">
    <?php if (isset($user) && $user->getId() !== null) : ?>
    Modifier <?= $user->getFirstname() ?> <?= $user->getLastname() ?>
    <?php else : ?>
    Ajouter un utilisateur
    <?php endif; ?>
    </h1>

    <a href="<?= $router->generate('user-list') ?>" class="btn btn-danger float-left">Retour</a>
    <form action="" method="POST" class="mt-5">
    <input type="hidden" name="token" value="<?= $token; ?>" />
        <div class="mb-3">
            <label for="email" class="form-label" >Email</label>
            <input type="email" class="form-control" id="email" value="<?=  (isset($user))?$user->getEmail() :"" ?>" name="email" placeholder="Mail de l'utilisateur">
            <?php if (isset($_SESSION['errors']['name'])) :?>
                <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe" aria-describedby="passwordHelpBlock">
            <?php if (isset($_SESSION['errors']['password'])) :?>
                <div id="passwordHelp" class="form-text text-danger"><?= $_SESSION['errors']['password'] ?></div>
            <?php else: ?>
                <div id="passwordHelp" class="form-text ">   Au moins : 8 caractères / 1 lettre minuscule / 1 lettre majuscule / un chiffre /  et un caractère spécial</div>

            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="firstname" class="form-label">Nom de famille</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="<?=  (isset($user))?$user->getFirstname() :"" ?>" placeholder="Nom de l'utilisateur" aria-describedby="firstnameHelpBlock">
            <?php if (isset($_SESSION['errors']['firstname'])) :?>
                <div id="firstnameHelp" class="form-text text-danger"><?= $_SESSION['errors']['firstname'] ?></div>

            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="lastname" value="<?=  (isset($user))?$user->getLastname() :"" ?>" id="lastname" placeholder="Prénom de l'utilisateur" aria-describedby="lastnameHelpBlock">
            <?php if (isset($_SESSION['errors']['lastname'])) :?>
                <div id="lastnameHelp" class="form-text text-danger"><?= $_SESSION['errors']['lastname'] ?></div>

            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="custom-select" id="role" name="role" aria-describedby="roleHelpBlock">
                <option value="">--Choisissez un rôle--</option>
                <option <?php if (isset($user) && $user->getRole() == 'manager') : ?>selected <?php endif; ?> value="manager">Manager</option>
                <option <?php if (isset($user) && $user->getRole() == 'admin') : ?>selected <?php endif; ?> value="admin">Admin</option>
                <option <?php if (isset($user) && $user->getRole() == 'guest') : ?>selected <?php endif; ?> value="guest">Guest</option>
            </select>
            <?php if (isset($_SESSION['errors']['role'])) :?>
                <div id="roleHelp" class="form-text text-danger"><?= $_SESSION['errors']['role'] ?></div>
            <?php else : ?>
                <div id="roleHelp" class="form-text ">Rôle de l'utilisateur (définit les permissions)</div>
            <?php endif; ?>   
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock">
                <option value="">--Choisissez un statut--</option>
                <option <?php if (isset($user) && $user->getStatus() == 1) : ?>selected <?php endif; ?> value="1">actif</option>
                <option <?php if (isset($user) && $user->getStatus() == 2) : ?>selected <?php endif; ?> value="2">désactivé</option>
            </select>
            <?php if (isset($_SESSION['errors']['status'])) :?>
                <div id="statusHelp" class="form-text text-danger"><?= $_SESSION['errors']['status'] ?></div>
            <?php else : ?>
                <div id="statusHelp" class="form-text ">Statut de l'utilisateur</div>
            <?php endif; ?>   
        </div>

        <button type="submit" class="my-4 btn btn-custom">Valider</button>

    </form>
</div>
<?php unset($_SESSION['errors']); ?>
