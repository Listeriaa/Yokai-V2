<?php
include 'inc/data.php';
$title = "Yōkai on the watch";
include "inc/head.tpl.php";
include "inc/nav.tpl.php";
include "inc/accueil.tpl.php";

include "inc/presentation.tpl.php";
?>
  
    <div class="display-none summary_responsive">
        <?php
        //je souhaite afficher l'image et le nom de chaque page Yokai sur ma page accueil, gestion du lien vers la page via GET
        foreach ($yokais as $yokai => $detail) :
        ?>
            <a href="yokai.php?yokai=<?= $yokai ?>">
                <article class=" article article_responsive">
                    <div class="image image_responsive">
                        <img src="images/<?= $detail['image'] ?>" alt="illustration de <?= $detail['nom'] ?>">
                    </div>
                    <h3 class="titre_image">
                        <?= $detail['nom'] ?>
                    </h3>
                </article>
            </a>
        <?php
        endforeach; ?>

    </div>
    </section>

<?php
include 'inc/footer.tpl.php';
?>