<?php

namespace App\Controllers;



class BackController extends CoreController
{
    /**
     * Method for the home page
     */
    public function home()
    {
    
        $this->show('back/home', ['type'=>'back office']);
    }

    
}