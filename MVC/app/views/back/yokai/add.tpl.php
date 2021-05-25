<?php
dump($_SESSION);
?>
<div class="container my-4">
    <h1 class="text-center">Ajouter un Yokai</h1>
    <a href="#" class="btn btn-success float-right">Retour</a>
    <form action="<?=$router->generate('back-yokaicreate')?>" method="POST" class="mt-5 yokai-add">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">3 caractères minimum</div>
        </div>
        <div class="mb-3">
            <label for="kanji" class="form-label">Kanji</label>
            <input type="text" class="form-control" id="kanji" name="kanji" aria-describedby="kanjiHelp">
            <div id="kanjiHelp" class="form-text">Ecriture japonaise</div>
        </div>
        <div class="mb-3">
            <label for="translation" class="form-label">Traduction</label>
            <input type="text" class="form-control" id="translation" name="translation" aria-describedby="translationHelp">
            <div id="translationHelp" class="form-text">Traduction du nom (5 caractères minimum)</div>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" aria-describedby="pictureHelp">
            <div id="pictureHelp" class="form-text">exemple : nom_du_yokai.jpg</div>
        </div>
        <div class="mb-3">
            <label for="habitat" class="form-label">Habitat</label>
            <input type="text" class="form-control" id="habitat" name="habitat" aria-describedby="habitatHelp">
            <div id="habitatHelp" class="form-text">5 caractères minimum</div>
        </div>
        <div class="mb-3">
            <label for="origin" class="form-label">Origine</label>
            <textarea type="text" class="form-control" id="origin" name="origin" aria-describedby="originHelp"></textarea>
            <div id="originHelp" class="form-text">Facultatif (sinon 20 caractères minimum)</div>
        </div>

        <div class="mb-3">
            <label for="appearance" class="form-label">Apparence</label>
            <textarea type="text" class="form-control" id="appearance" name="appearance" aria-describedby="appearanceHelp"></textarea>
            <div id="appearanceHelp" class="form-text">50 caractères minimum</div>
        </div>
        <div class="mb-3">
            <label for="behavior" class="form-label">Comportement</label>
            <textarea type="text" class="form-control" id="behavior" name="behavior" aria-describedby="behaviorHelp"></textarea>
            <div id="behaviorHelp" class="form-text">50 caractères minimum</div>
        </div>

        <button type="submit" class="btn btn-custom">Submit</button>
    </form>
</div>