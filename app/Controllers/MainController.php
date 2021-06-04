<?php

namespace App\Controllers;

use App\Models\Yokai;

class MainController extends CoreController
{
    /**
     * Method for the home page
     */
    public function home()
    {
      
        $this->show('main/home', ['title'=>'Yōkai on the watch', 'yokai'=>Yokai::getRandomYokai()]);
    }

}