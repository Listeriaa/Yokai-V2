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

    public function create($id=null){
        $name = trim(addslashes(filter_input(INPUT_POST, 'name')));
        $kanji = trim(addslashes(filter_input(INPUT_POST, 'kanji')));
        $translation = trim(addslashes(filter_input(INPUT_POST, 'translation')));
        $picture = trim(addslashes(filter_input(INPUT_POST, 'picture')));
        $habitat = trim(addslashes(filter_input(INPUT_POST, 'habitat')));
        $origin = trim(addslashes(filter_input(INPUT_POST, 'origin')));
        $appearance = trim(addslashes(filter_input(INPUT_POST, 'appearance')));
        $behavior = trim(addslashes(filter_input(INPUT_POST, 'behavior')));

        //je décide quelle requête doit être appelé en fonction de si y'a une ID (modif) ou non.
        if ($id == null) {
            // On est dans le cas d'une création
            // on crée un objet vide
            $request = 'insert';
            $user = new Yokai();
            
        } else {
            // On est dans le cas d'une mise à jour
            $request = 'update';
            $user = Yokai::getYokaiById($id);
        }

       // J'utilise les setter pour valider les données ou retourner false. Si false, le checkValue remplira le tableau d'erreurs
        $name=$this->checkValue($user->setName($name), "Nombre de caractères insuffisant (3 minimum)");
        $kanji=$this->checkValue($user->setKanji($kanji), "Non conforme");
        $translation=$this->checkValue($user->setTranslation($translation), "Nombre de caractères insuffisant (5 minimum)");
        $picture=$this->checkValue($user->setPicture($picture), "le format de l'image doit être .jpg ou .png");
        $habitat=$this->checkValue($user->setHabitat($habitat), "Nombre de caractères insuffisant (5 minimum)");
        $origin=$this->checkValue($user->setOrigin($origin), "Nombre de caractères insuffisant (20 minimum)");
        $appearance=$this->checkValue($user->setAppearance($appearance), "Nombre de caractères insuffisant (30 minimum)");
        $behavior=$this->checkValue($user->setBehavior($behavior), "Nombre de caractères insuffisant (50 minimum)");


  
        // Si le tableau d'erreur n'est pas vide, je re-crée un token, et j'appelle la methode show sur le tpl add
        //sinon, je lance la requete.
            //si pas d'erreur, je rajoute le message de succès et je redirige vers la liste
            //sinon la requete a échouée

        if (!empty($_SESSION['errors'])){
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            $this->show('user/add', [$_SESSION['errors'], 'user'=>$user, 'token'=>$token, 'request'=>$request]);
        } else{
            
            if ($user->$request()) {
                ($request == 'insert')?$this->addFlashInfo("l'ajout a bien été effectué"):$this->addFlashInfo("la modification a bien été effectuée");
                
                header('Location: '.$router->generate('user-list'));
            }else{
                echo "la requête a échouée";
            }
        }
    }
}