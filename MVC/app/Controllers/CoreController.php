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

        // 3) if the currentRoute is in ACL array
        if (isset($this->acl[$currentRouteName])) {
            $roles = $this->acl[$currentRouteName];
            //check if userRole is in acl array 
            $this->checkAuthorization($roles);
        }
    }

        /**
     *Method to check if role of currentUser match authorization
     *
     * @param array $roles
     * @return void
     */
    public function checkAuthorization($roles)
    {
        // check if user is connected
        if (isset($_SESSION['isConnected'])) {
            // recover user information
            $currentUser = $_SESSION['userObject'];

            // Recover his role
            $userRole = $currentUser->getRole();

            //if userRole is in array role of the current Route
            if (in_array($userRole, $roles)) {
                
                return true;
            } else {
                //user doesn't have authorization
                http_response_code(403);
                $this->show('back/error/403');

                exit;
            }
        } else {
            // if not connected
            header('Location: ' . $this->router->generate('user-login'));
            exit;
        }
    }

    public function checkCSRFToken($currentRouteName)
    {

        // if current Route needs a CSRF check
        if (in_array($currentRouteName, $this->csrfTokenToCheck)) {
            // Recover of the token sent by GET or POST
            $token = $_POST['token'] ?? $_GET['token'] ?? '';

            // recover of the token sent by the controller
            $sessionToken = $_SESSION['token'] ?? '';

            
            if (empty($token) || $token !== $sessionToken) {
                // Alors on affiche une 403
                http_response_code(403);
                $this->show('back/error/403');
                exit;
            }
            
            else {
                
                unset($_SESSION['token']);
            }
        }
    }

    /**
     * Csrf Token generator
     */
    public function generateToken()
    {
 
        $token = bin2hex(random_bytes(32));
        
        $_SESSION['token'] = $token;

        return $token;
    }

    /**
     * test method
     *
     * @return void
     */
    public function test(){
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
        //if empty, creation of the array
        if (empty($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }

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
        // if empty, creation of the array
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
     *Show method
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewVars = [])
    {
        // On récupère la propriété $router que l'on transmet aux vues
        $router = $this->router;
 
        $viewVars['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];
        
        extract($viewVars);
       
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