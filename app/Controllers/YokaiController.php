<?php

namespace App\Controllers;

use App\Models\Yokai;


class YokaiController extends CoreController
{
    /**
     * Method for the yokai list page on the front office
     */
    public function list()
    {
        $this->show('yokai/list', ['title'=>'Tous les Yōkai', 'yokaiList'=>Yokai::all('yokai')]);
    }

    /**
     * method to show a yokai by ID on the front office
     *
     * @param string $id du yokai
     * @return void
     */
    public function showById($id){
        $yokai = Yokai::find($id, 'yokai');
        if($yokai){
            $title=$yokai->getName();
            $this->show('yokai/article', ['title'=>$title, 'yokai'=>$yokai]);
        }else {
            http_response_code(404);
            $this->show('back/error/404');
            exit;
        }

    }

    /**
     * method to show all yokai on the back office home page
     *
     * @return void
     */
    public function backlist(){
        $token = $this->generateToken();
        $this->show('back/list', ['type'=>'yokai','token'=>$token, 'list'=>Yokai::all('yokai')]);
    }

    /**
     * method GET to show the form to add or update a yokai
     *
     * @param [type] $id
     * @return void
     */
    public function add($id=null){
        $token = $this->generateToken();

        $yokai=null;
        if(isset($id)){
            $yokai = Yokai::find($id,'yokai');
            if($yokai== false){
                http_response_code(404);
                $this->show('back/error/404');
                exit;
            }

        }
        
        $this->show('back/yokai/add',['type'=>'yokai','token'=>$token,'yokai'=>$yokai]);

    }

    /**
     * method POST to insert or update datas in the database
     *
     * @param [type] $id
     * @return void
     */
    public function createOrUpdate($id=null){

        // check, clean and validate inputs from the form
        $name = $this->dataValidate(filter_input(INPUT_POST, 'name'));
        $kanji = $this->dataValidate(filter_input(INPUT_POST, 'kanji'));
        $translation = $this->dataValidate(filter_input(INPUT_POST, 'translation'));
        $picture = $this->dataValidate(filter_input(INPUT_POST, 'picture'));
        $habitat = $this->dataValidate(filter_input(INPUT_POST, 'habitat'));
        $origin = $this->dataValidate(filter_input(INPUT_POST, 'origin'));
        $appearance = $this->dataValidate(filter_input(INPUT_POST, 'appearance'));
        $behavior = $this->dataValidate(filter_input(INPUT_POST, 'behavior'));
        $alt = $this->dataValidate(filter_input(INPUT_POST, 'alt'));

        
        //If id is null, it is a insert, if not, it is an update
        if ($id == null) {
            // On est dans le cas d'une création
            // on crée un objet vide
            $request = 'insert';
            $yokai = new Yokai();
            
        } else {
            // On est dans le cas d'une mise à jour
            $request = 'update';
            $yokai = Yokai::find($id, 'yokai');
        }
        
       // I check the value with setters : if it returns false, i push the errors in the $_SESSION['errors'], else
       // the data is valid and it is set
        $name=$this->checkValue($yokai->setName($name),"name", "Nombre de caractères insuffisant (3 minimum)");
        $kanji=$this->checkValue($yokai->setKanji($kanji),"kanji", "Non conforme");
        $translation=$this->checkValue($yokai->setTranslation($translation),"translation", "Nombre de caractères insuffisant (5 minimum)");
        $picture=$this->checkValue($yokai->setPicture($picture),"picture", "le format de l'image doit être .jpg ou .png");
        $habitat=$this->checkValue($yokai->setHabitat($habitat),'habitat', "Nombre de caractères insuffisant (5 minimum)");
        $origin=$this->checkValue($yokai->setOrigin($origin),"origin", "Nombre de caractères insuffisant (20 minimum)");
        $appearance=$this->checkValue($yokai->setAppearance($appearance),"appearance", "Nombre de caractères insuffisant (50 minimum)");
        $behavior=$this->checkValue($yokai->setBehavior($behavior),"behavior", "Nombre de caractères insuffisant (50 minimum)");
        $alt=$this->checkValue($yokai->setAlt($alt),"alt", "Nombre de caractères insuffisant (3 minimum)");

        

        // If array is not empty, there is errors, so I go back on the form 
            //else, if empty and the request is successfull, i head towards the list with successfull flash message
            //else if request failed, i head towards the list with errors message

        if (!empty($_SESSION['errors'])){
            $token = $this->generateToken();
            $this->show('back/yokai/add', [$_SESSION['errors'], 'yokai'=>$yokai, 'token'=>$token, 'type'=>'yokai']);
        } else{
            
            if ($yokai->$request()) {
               
                ($request == 'insert')?$this->addFlashInfo("l'ajout a bien été effectué"):$this->addFlashInfo("la modification a bien été effectuée");
                $this->redirect('yokai-backlist');
                exit;
                
            }else{
              
                $this->addFlashInfo("la requête a échouée");
                $this->redirect('yokai-backlist');
                exit;
            }
        }
    }

    public function delete($id){
        $yokai = Yokai::find($id,'yokai');
        
        if ($yokai->delete()) {
               
            $this->addFlashInfo("la suppression a bien été effectuée");
            $this->redirect('yokai-backlist');
            exit;
            
        }else{
          
            $this->addFlashInfo("la requête a échouée");
            $this->redirect('yokai-backlist');
            exit;
        }
    }
}
