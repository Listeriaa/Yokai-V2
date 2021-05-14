<?php

namespace App\Controllers;




class YokaiController extends CoreController
{
    /**
     * Method for the yokai list page
     */
    public function list()
    {
    

        
        $this->show('yokai/list', ['title'=>'Tous les Yōkai']);
    }

    public function showById($id){
        $title="";
        $this->show('yokai/article', ['title'=>$title]);
    }
}