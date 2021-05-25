<?php

namespace App\Controllers;

use App\Models\Yokai;


class YokaiController extends CoreController
{
    /**
     * Method for the yokai list page
     */
    public function list()
    {
        $this->show('yokai/list', ['title'=>'Tous les Yōkai', 'yokaiList'=>Yokai::getAllYokai()]);
    }


    public function showById($id){
        $yokai = Yokai::getYokaiById($id);
        $title=$yokai->getName();
        $this->show('yokai/article', ['title'=>$title, 'yokai'=>$yokai]);
    }

    public function backlist(){
        $this->show('back/list', ['type'=>'yokai','list'=>Yokai::getAllYokai()]);
    }

    public function add(){
        $this->show('back/yokai/add');

    }

    public function createOrUpdate($id=null){
        $name = $this->dataValidate(filter_input(INPUT_POST, 'name'));
        $kanji = $this->dataValidate(filter_input(INPUT_POST, 'kanji'));
        $translation = $this->dataValidate(filter_input(INPUT_POST, 'translation'));
        $picture = $this->dataValidate(filter_input(INPUT_POST, 'picture'));
        $habitat = $this->dataValidate(filter_input(INPUT_POST, 'habitat'));
        $origin = $this->dataValidate(filter_input(INPUT_POST, 'origin'));
        $appearance = $this->dataValidate(filter_input(INPUT_POST, 'appearance'));
        $behavior = $this->dataValidate(filter_input(INPUT_POST, 'behavior'));

        
        //!utiliser validateData et verifier quoi utiliser comme filtres (attention, y'a des balises dans le texte)
        //je décide quelle requête doit être appelé en fonction de si y'a une ID (modif) ou non.
        if ($id == null) {
            // On est dans le cas d'une création
            // on crée un objet vide
            $request = 'insert';
            $yokai = new Yokai();
            
        } else {
            // On est dans le cas d'une mise à jour
            $request = 'update';
            $yokai = Yokai::getYokaiById($id);
        }

       // J'utilise les setter pour valider les données ou retourner false. Si false, le checkValue remplira le tableau d'erreurs
        $name=$this->checkValue($yokai->setName($name), "Nombre de caractères insuffisant (3 minimum)");
        $kanji=$this->checkValue($yokai->setKanji($kanji), "Non conforme");
        $translation=$this->checkValue($yokai->setTranslation($translation), "Nombre de caractères insuffisant (5 minimum)");
        $picture=$this->checkValue($yokai->setPicture($picture), "le format de l'image doit être .jpg ou .png");
        $habitat=$this->checkValue($yokai->setHabitat($habitat), "Nombre de caractères insuffisant (5 minimum)");
        $origin=$this->checkValue($yokai->setOrigin($origin), "Nombre de caractères insuffisant (20 minimum)");
        $appearance=$this->checkValue($yokai->setAppearance($appearance), "Nombre de caractères insuffisant (50 minimum)");
        $behavior=$this->checkValue($yokai->setBehavior($behavior), "Nombre de caractères insuffisant (50 minimum)");

        dd($_SESSION['errors']);
  
        // Si le tableau d'erreur n'est pas vide, je re-crée un token, et j'appelle la methode show sur le tpl add
        //sinon, je lance la requete.
            //si pas d'erreur, je rajoute le message de succès et je redirige vers la liste
            //sinon la requete a échouée

        if (!empty($_SESSION['errors'])){
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            $this->show('back/yokai/add', [$_SESSION['errors'], 'yokai'=>$yokai, 'token'=>$token, 'request'=>$request]);
        } else{
            
            if ($yokai->$request()) {
                ($request == 'insert')?$this->addFlashInfo("l'ajout a bien été effectué"):$this->addFlashInfo("la modification a bien été effectuée");
                
                
            }else{
                echo "la requête a échouée";
            }
        }
    }
}