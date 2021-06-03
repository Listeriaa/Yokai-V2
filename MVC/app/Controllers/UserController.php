<?php 

namespace App\Controllers;

use App\Models\User;

class UserController extends CoreController {

    /**
     * Method to connection form
     *
     * @return void
     */
    public function login() {
        
  
        $this->show('back/user/login', ['type'=>null]);
    }

    /**
     * method to logout
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        unset($_SESSION['isConnected']);

        
        $this->redirect('back-home');
        exit;
    }

    /**
     * method to check if user exists in database
     *
     * @return void
     */
    public function doLogin() {
        // 1) On récupère les infos du formulaire
        
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        
        $password = trim(filter_input(INPUT_POST, 'password'));

        
        // 2) On interroge la BDD pour savoir si l'utilisateur existe
        $user = User::findByEmail($email);
        
        if($user && password_verify($password, $user->getPassword())){
            if ($user->getRole()=='1'){
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                $_SESSION['isConnected']=true;
                $this->redirect('back-home');
            } else {
                $this->redirect('user-login', ['error'=> 'utilisateur inactif']);
            }


         }else{
            
            $this->redirect('user-login', ['error'=> 'Utilisateur et/ou mot de passe inconnu']);

        }
    
    }

    public function list(){
        
        // On affiche le contenu de la vue
        // views/user/list.tpl.php
        $this->show('back/list', ['type'=>'user', 'list' => User::all('user')]);
    }
    public function add($id=null)
    {
        $user = null;

        if(isset($id)){
            $user = User::find($id,'user');
        }
        $this->show('back/user/add', ['type'=>'user', 'user'=>$user]);
    }

    public function updateOrDelete($action, $id)
    {
    
        
        $user = User::find('user', $id);
        switch ($action) {


            case 'update':
               
                $this->show('user/add', ['id' => $id, 'type' => 'user', 'user' => $user]);
                break;
            case 'delete':


                $result = $user->delete($id);
                if ($result) {
                    $this->redirect('user-list');
                    
                } else {
                    echo "la requête a échouée";
                }

                break;
        }
    }
    public function createOrUpdate($id = null)
    {
        
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $firstname = trim(addslashes(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
        $lastname = trim(addslashes(filter_input(INPUT_POST, 'lastname',FILTER_SANITIZE_STRING)));
        $password = filter_input(INPUT_POST, 'password');
        $role = filter_input(INPUT_POST, 'role');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        


    
        // 2) On instancie la classe Product
        if ($id == null) {
            // On est dans le cas d'une création de produit
            // on crée un objet vide
            $request = 'insert';
            $user = new User();
        } else {
            // On est dans le cas d'une mise à jour de produit
            $request = 'update';
            $user = User::find(' user', $id);
        }

        $email = $user->setEmail($email);
         
        $firstname = $user->setFirstname($firstname);
        
        $lastname = $user->setLastname($lastname);
        $password = $user->setPassword($password);
        $role = $user->setRole($role);
        $status = $user->setStatus($status);
        // $email=$this->checkValue($user->setEmail($email), 'mail');
        // $password=$this->checkValue($user->setPassword($password), 'password');
        // $firstname=$this->checkValue($user->setFirstname($firstname), 'firstname');
        // $lastname=$this->checkValue($user->setLastname($lastname), 'lst');
        // $status=$this->checkValue($user->setStatus($status), 'status');
        

        if ($email === false || $firstname === false || $lastname === false ||  $password === false || $role===false || $status === false) {

            $this->show('user/add', ['firstname'=>$firstname, 'password'=>$password, 'email' => $email, 'lastname' => $lastname, 'role'=>$role, 'status'=>$status, 'user' => $user]);
        } else {
            if ($user->$request($id)) {
                header("Location: " . $router->generate('user-list'));
            } else {
                echo "la requête a échouée";
            }
        }
    }
}