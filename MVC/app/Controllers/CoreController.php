<?php

// Every Controller MUST extends this class

namespace App\Controllers;

use App\Models\Yokai;

abstract class CoreController
{
    protected $router;
    private $currentRouteName;
    private $csrfTokenToCheck;
    private $acl;

    public function __construct($router, $match)
    {
        
        $this->router = $router;

        // Current route name from altoRouter match
        //null coalescent
        $this->currentRouteName = $match['name'] ?? '';
        
        // Security rules
        require __DIR__ . '/../security.php';

        $this->csrfTokenToCheck = $csrfTokenToCheck;
        $this->acl = $acl;

        // ACL check
        $this->checkACL($this->currentRouteName);

        // Anti CSRF check
        $this->checkCSRFToken($this->currentRouteName);
    }

    public function checkACL($currentRouteName)
    {
        // ACL : Access Control List
        // Permet de centraliser la gestion des autorisations
        
        
        
        // 3) Si la route actuelle est dans la liste des ACL
        if (isset($this->acl[$currentRouteName])) {
            $roles = $this->acl[$currentRouteName];
            
            // On va vérifier que la personne actuellement connectée
            // a le droit d'afficher cette route courante

            $this->checkAuthorization($roles);
        }
    }

        /**
     * Méthode permettant de décicer si l'on est autorisée
     * à affectuer une action donnée en fonction des roles tranmis
     * en arugments
     *
     * @param array $roles
     * @return void
     */
    public function checkAuthorization($roles)
    {
        // On vérifie Si le user connecté
        if (isset($_SESSION['isConnected'])) {
            // On récupère les données de l'utilisateur connecté (Session)
            $currentUser = $_SESSION['userObject'];

            // On récupère le role de l'utilisateur
            $userRole = $currentUser->getRole();

            // On compare le role de l'utilisateur à celui présent dans $role
            // Si le rôle de l'utilisateur courant fait partie
            // des rôles autorisés ($roles)
            
            if (in_array($userRole, $roles)) {
                // alors on retourne vrai
                return true;
            } else {
                // Si le rôle de l'utilisateur ne lui permet d'effectuer
                // l'action courant 
                // On retourne une page 403
                // Puis on gère l'affichage
                http_response_code(403);
                $this->show('error/err403');

                // On stoppe l'execution du script PHP : on arrete TOUT
                exit;
            }
        } else {
            // Si non connecté...on redirige vers le formulaire de connexion
            header('Location: ' . $this->router->generate('user-login'));
            exit;
        }
    }

    public function checkCSRFToken($currentRouteName)
    {

        // Si la route actuelle nécessite la vérification d'un token anti-CSRF
        if (in_array($currentRouteName, $this->csrfTokenToCheck)) {
            // On récupère le token en POST ou en GET
            $token = $_POST['token'] ?? $_GET['token'] ?? '';

            // On récupère le token en SESSION
            $sessionToken = $_SESSION['token'] ?? '';

            // S'ils ne sont pas égaux ou vide
            if (empty($token) || $token !== $sessionToken) {
                // Alors on affiche une 403
                http_response_code(403);
                $this->show('error/err403');
                exit;
            }
            // Sinon, tout va bien
            else {
                // On supprime le token en session
                // Ainsi, on ne pourra pas soumettre plusieurs fois le même formulaire, ni réutiliser ce token
                unset($_SESSION['token']);
            }
        }
    }

    /**
     * Csrf Token generator
     */
    public function generateToken()
    {
        // 1) On génère un code unique

        $token = bin2hex(random_bytes(32));

        // 2) On stocke ce code unique en Session
        $_SESSION['token'] = $token;

        // 3) Que l'on retourne au controller
        return $token;
    }

    /**
     * test method
     *
     * @return void
     */
    public function test(){
        $yokai = Yokai::all('yokai');
        
        $this->show('error/test.tpl.php');
    }

    /**
     * redirection method
     *
     * @param string $currentRouteName
     * @param array $params
     * @return void
     */
    public function redirect($currentRouteName, $params = [])
    {
        header('Location:' . $this->router->generate($currentRouteName, $params));
    }

    /**
     * method to add a error message
     *
     * @param string $data to check
     * @param string $message to show if errors
     * @return void
     */
    public function addFlashError($data, $message)
    {
        // On vérifie d'abord que la clé de stockage des messages
        // existe
        if (empty($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }

        // On ajoute le message d'erreur dans un tableau en session
        $_SESSION['errors'][$data] = $message;
    }

    /**
     * method to add a information
     *
     * @param string $message to show
     * @return void
     */
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

    /**
     * methode to validate a data from a form
     *
     * @param string $data
     * @return 
     */
    function dataValidate($data){
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * method to check if the data value is correct
     *
     * @param string or boolean $dataValue
     * @param string $data
     * @param string $message
     * @return void
     */
    public function checkValue($dataValue, $data, $message){
        if($dataValue === false){
            $this->addFlashError($data, $message);
            return $dataValue;
        }
        return $dataValue;
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
        dump($_SESSION);
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