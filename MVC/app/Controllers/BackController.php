<?php

namespace App\Controllers;



class BackController extends CoreController
{
    /**
     * Method for the home page
     */
    public function home()
    {
        
        // For now, this page only needs the view
        $this->show('back/home');
    }

    
}