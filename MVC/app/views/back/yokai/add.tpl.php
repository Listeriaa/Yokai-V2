<?php
if (isset($yokai)){
    dump($yokai->getName());
}
?>
<div class="container my-4">
    <h1 class="text-center">Ajouter un Yokai</h1>
    <a href="<?= $router->generate('back-yokailist')?>" class="btn btn-success float-right">Retour</a>
    <form action="<?=$router->generate('back-yokaicreate')?>" method="POST" class="mt-5 yokai-add">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" value="<?= (isset($yokai))? $yokai->getName() :"" ?>" name="name" aria-describedby="nameHelp">
            <?php if (isset($_SESSION['errors']['name'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['name'] ?></div>
            <?php else: ?>
            <div id="nameHelp" class="form-text ">3 caractères minimum</div>
            <?php endif;?>
        </div>
        <div class="mb-3">
            <label for="kanji" class="form-label">Kanji</label>
            <input type="text" class="form-control" id="kanji" name="kanji" value="<?= (isset($yokai))? $yokai->getKanji() :"" ?>" aria-describedby="kanjiHelp">
            <?php if (isset($_SESSION['errors']['kanji'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['kanji'] ?></div>
            <?php else: ?>
                <div id="kanjiHelp" class="form-text">Ecriture japonaise</div>
            <?php endif;?>
            
        </div>
        <div class="mb-3">
            <label for="translation" class="form-label">Traduction</label>
            <input type="text" class="form-control" id="translation" name="translation" value="<?= (isset($yokai))? $yokai->getTranslation() :"" ?>" aria-describedby="translationHelp">
            <?php if (isset($_SESSION['errors']['translation'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['translation'] ?></div>
            <?php else: ?>
                <div id="translationHelp" class="form-text">Traduction du nom (5 caractères minimum)</div>
            <?php endif;?>
            
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" value="<?= (isset($yokai))? $yokai->getPicture() :"" ?>" aria-describedby="pictureHelp">
            <?php if (isset($_SESSION['errors']['picture'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['picture'] ?></div>
            <?php else: ?>
                <div id="pictureHelp" class="form-text">exemple : nom_du_yokai.jpg</div>
            <?php endif;?>
            
        </div>
        <div class="mb-3">
            <label for="habitat" class="form-label">Habitat</label>
            <input type="text" class="form-control" id="habitat" name="habitat" value="<?= (isset($yokai))? $yokai->getHabitat() :"" ?>" aria-describedby="habitatHelp">
            <?php if (isset($_SESSION['errors']['habitat'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['habitat'] ?></div>
            <?php else: ?>
                <div id="habitatHelp" class="form-text">5 caractères minimum</div>
            <?php endif;?>
            
        </div>
        <div class="mb-3">
            <label for="origin" class="form-label">Origine</label>
            <textarea type="text" class="form-control" id="origin" name="origin" value="<?= (isset($yokai))? $yokai->getOrigin() :"" ?>" aria-describedby="originHelp"></textarea>
            <?php if (isset($_SESSION['errors']['origin'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['origin'] ?></div>
            <?php else: ?>
                <div id="originHelp" class="form-text">Facultatif (sinon 20 caractères minimum)</div>
            <?php endif;?>
            
        </div>

        <div class="mb-3">
            <label for="appearance" class="form-label">Apparence</label>
            <textarea type="text" class="form-control" id="appearance" name="appearance" value="<?= (isset($yokai))? $yokai->getAppearance() :"" ?>" aria-describedby="appearanceHelp"></textarea>
            <?php if (isset($_SESSION['errors']['appearance'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['appearance'] ?></div>
            <?php else: ?>
                <div id="appearanceHelp" class="form-text">50 caractères minimum</div>
            <?php endif;?>
            
        </div>
        <div class="mb-3">
            <label for="behavior" class="form-label">Comportement</label>
            <textarea type="text" class="form-control" id="behavior" value="<?= (isset($yokai))? $yokai->getBehavior() :"" ?>" name="behavior" aria-describedby="behaviorHelp"></textarea>
            <?php if (isset($_SESSION['errors']['behavior'])) :?>
            <div id="nameHelp" class="form-text text-danger"><?= $_SESSION['errors']['behavior'] ?></div>
            <?php else: ?>
                <div id="behaviorHelp" class="form-text">50 caractères minimum</div>
            <?php endif;?>
            
        </div>

        <button type="submit" class="btn btn-custom">Submit</button>
    </form>
</div>

<?php unset($_SESSION['errors']); ?>