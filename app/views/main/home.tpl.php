<?php
//dd($yokai);
?>
<div class="accueil">
    <h1>Yōkai on the watch<span lang="ja" class="kanji">愛 妖怪</span></h1>
    <div class="div-scroll">
        <i class="fas fa-angle-double-down"></i>
    </div>
</div>
<section class="presentation display-none">
    <div class="presentation_responsive">
        <h3>Qu'est ce qu'un yōkai?</h3>
        <p>Les  (<span  lang="ja" >妖怪</span>, « esprit », « fantôme ») sont un type de créatures surnaturelles dans le folklore japonais. Ils peuvent être malfaisants et dangereux, comme la célèbre Kuchisake onna (« femme à la bouche fendue ») ou juste malicieux à l'instar de l'Akaname (« lèche-crasse ») dont le seul hobbie est de lécher la saleté des baignoires.  Au Japon, encore aujourd'hui, la plupart des phénomènes surnaturels ou inexplicables sont attribués aux yōkai, et bien qu'ils existent depuis le moyen-âge nippon, certains sont nés récemment, grâce à l'imagination de mangakas comme Shigeru Mizuki.</p>
    </div>

    <div class="presentation_responsive random">

        <a href="<?= $router->generate('yokai-showbyid', ['id'=>$yokai->getId()])?>">
            <article class=" random-article article_responsive">
                <div class="image image_responsive blur">
                    <img src="assets/<?=$yokai->getPicture()?>" alt="illustration de yokai">
                    
                </div>
                
                <h3 class="titre_image">
                    Un yōkai au hasard....
                </h3>
            </article>
        </a>
        
    </div>
</section>
