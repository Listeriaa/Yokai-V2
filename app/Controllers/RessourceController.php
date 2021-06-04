<?php

namespace App\Controllers;


class RessourceController extends CoreController
{
    /**
     * Method for the ressource page
     */
    public function list(){
        $this->show('ressource/more', ['title'=>'Ressources sur les yōkai']);
    }
}