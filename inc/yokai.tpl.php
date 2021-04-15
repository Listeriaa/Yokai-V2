 
<section class="page_article">
    <article>
        <h2><?=$yokais[$yokai]["nom"]?> <?=$yokais[$yokai]["japonais"]?></h2>
        <div class="image_article_responsive image_float">
            <img src="images/<?=$yokais[$yokai]["image"]?>" alt="illustration de <?=$yokais[$yokai]["nom"]?>">
        </div>
        <div class="descriptif_article_responsive">
            <h3>Traduction :</h3>
            <p><?=$yokais[$yokai]["traduction"]?></p>
            <h3>Habitat :</h3>
            <p><?=$yokais[$yokai]["habitat"]?></p>
            <?php
            //Je n'affiche ce paragraphe que si la clé "origine" existe dans le sous-tableau du yokai
            if (array_key_exists('origine', $yokais[$yokai])):
            ?>
            <h3>Origines :</h3>
            <p><?=$yokais[$yokai]["origine"]?></p>
            <?php
            endif;
            ?>
            <h3>Apparence :</h3>
            <p><?=$yokais[$yokai]["apparence"]?></p>
            <h3>Comportement :</h3>
            <p><?=$yokais[$yokai]["comportement"]?></p>
        </div>

    </article>
</section>