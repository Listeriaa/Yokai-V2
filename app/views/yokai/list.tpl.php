

<section class="presentation notransition">

        

        <div class="summary_responsive">
            
            <?php foreach ($yokaiList as $yokai) : ?>
                <a href="<?= $router->generate('yokai-showbyid', ['id'=>$yokai->getId()])?>">
                    <article class=" article article_responsive">
                    <div class="image image_responsive">
                        <img src="assets/<?=$yokai->getPicture()?>" alt="<?= $yokai->getAlt() ?>">
                    </div>
                    <h3 class="titre_image">
                    <?=$yokai->getName()?>
                    </h3>
                </article>
            </a>
        <?php endforeach; ?>
        </div>
</section>