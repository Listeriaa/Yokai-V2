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
        $this->show('back/yokai/list', ['type'=>'yokai','list'=>Yokai::getAllYokai()]);
    }
}