 
<section class="page_article">
    
    <article class="clearfix">
        <h2><?= $yokai->getName() ?> <span  lang="ja" ><?= $yokai->getKanji() ?></span></h2>
        <div class="image_article_responsive image_float">
            <img src="<?= $assetsBaseUri.$yokai->getPicture() ?>" alt="<?= $yokai->getAlt() ?>">
        </div>
        <div class="descriptif_article_responsive">
            <h3>Traduction :</h3>
            <p><?= $yokai->getTranslation() ?></p>
            <h3>Habitat :</h3>
            <p><?= $yokai->getHabitat() ?></p>
        <?php if ($yokai->getOrigin()!==null): ?>
            <h3>Origines :</h3>
            <p><?= $yokai->getOrigin() ?></p>
        <?php endif; ?>
            <h3>Apparence :</h3>
            <p><?= $yokai->getAppearance() ?></p>
            <h3>Comportement :</h3>
            <p><?= $yokai->getBehavior() ?></p>
        </div>

    </article>
</section>