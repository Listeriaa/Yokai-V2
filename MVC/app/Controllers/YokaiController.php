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
        $title="";
        $this->show('yokai/article', ['title'=>$title]);
    }
}