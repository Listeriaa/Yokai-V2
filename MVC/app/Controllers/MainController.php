<?php

namespace App\Controllers;




class MainController extends CoreController
{
    /**
     * Method for the home page
     */
    public function home()
    {
    

        // For now, this page only needs the view
        $this->show('main/home', ['title'=>'Yōkai on the watch']);
    }
}