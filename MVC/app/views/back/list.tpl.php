
<div class="container d-flex flex-column align-items-center my-4">
    <h1 class="text-center">Gestion de la table : <?=$type?></h1>
    <a href="<?= $router->generate($type.'-add')?>" class="btn btn-custom">Ajouter un <?=$type?></a>
    
    <table class="table table-hover mt-4 w-75">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $element): ?>
                <tr>
                    <td scope="row"><?= $element->getId() ?></td>
                    <td><?= ($type == 'yokai')? $element->getName() : $element->getFirstname().' '.$element->getLastname()?> </td>
                    <td class="text-center">
                        <a href="<?=($type == 'yokai')? $router->generate('yokai-update', ['id'=>$element->getId()]):$router->generate('user-update', ['id'=>$element->getId()])?>" role="button" class="btn btn-warning">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=($type == 'yokai')? $router->generate('yokai-delete', ['id'=>$element->getId()]):$router->generate('user-delete', ['id'=>$element->getId()])?>?token=<?=$token?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>