<?php

// Every Controller MUST extends this class

namespace App\Controllers;

abstract class CoreController
{
    protected $router;
    public function __construct($router)
    {
        
        $this->router = $router;

    }

    public function redirect($currentRouteName, $params = [])
    {
        header('Location:' . $this->router->generate($currentRouteName, $params));
    }

    public function addFlashError($message)
    {
        // On vérifie d'abord que la clé de stockage des messages
        // existe
        if (empty($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }

        // On ajoute le message d'erreur dans un tableau en session
        $_SESSION['errors'][] = $message;
    }

    public function addFlashInfo($message)
    {
        // On vérifie d'abord que la clé de stockage des messages
        // existe
        if (empty($_SESSION['infos'])) {
            $_SESSION['infos'] = [];
        }

        // On ajoute le message d'erreur dans un tableau en session
        $_SESSION['infos'][] = $message;
    }


    public function checkValue($value, $message){
        if($value === false){
            $this->addFlashError($message);
            return $value;
        }
        return $value;
    }
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = [])
    {
        // On récupère la propriété $router que l'on transmet aux vues
        $router = $this->router;
        
        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];
        
        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau
        
       
        if (substr($viewName, 0,4) == 'back'){
            require_once __DIR__ . '/../views/back/layout/header.tpl.php';
            require_once __DIR__ . '/../views/'. $viewName . '.tpl.php';
            require_once __DIR__ . '/../views/back/layout/footer.tpl.php';
        } else {
            require_once __DIR__ . '/../views/layout/header.tpl.php';
            require_once __DIR__ . '/../views/'. $viewName . '.tpl.php';
            require_once __DIR__ . '/../views/layout/footer.tpl.php';
        }

    }
}