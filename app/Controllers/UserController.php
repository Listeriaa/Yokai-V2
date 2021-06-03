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
        
        $token = $this->generateToken();
        
        $this->show('back/user/login', ['token'=>$token]);
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
        // Recover of Post datas
        
        $email = $this->dataValidate(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $password = $this->dataValidate(filter_input(INPUT_POST, 'password'));

        
        $user = User::findByEmail($email);
        
        //if user exists and password matches
        if($user && password_verify($password, $user->getPassword())){

            // if user is active
            if ($user->getStatus()=='1'){

                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                $_SESSION['isConnected']=true;
                $this->redirect('back-home');
                exit;

            } else {
                $this->addFlashInfo('Utilisateur désactivé');
                $this->redirect('user-login');
                exit;
            }
        }else{
            $this->addFlashInfo('l\'email et/ou le mot de passe sont incorrects');
            $this->redirect('user-login');
            exit;
        }
    
    }

    public function list(){

        $token = $this->generateToken();
        $this->show('back/list', ['type'=>'user','token'=>$token, 'list' => User::all('user')]);
    }

    public function add($id=null)
    {
        $user = null;
        $token = $this->generateToken();

        //if there is an id, it is an update
        if(isset($id)){
            $user = User::find($id,'user');

            //if it doesn't exist
            if($user == false){
                http_response_code(404);
                $this->show('back/error/404');
                exit;
            }

        }
        $this->show('back/user/add', ['type'=>'user', 'user'=>$user, 'token'=>$token]);
    }


    public function createOrUpdate($id = null)
    {
        //recover of datas from POST and validate/sanitize

        $email = $this->dataValidate(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $firstname = $this->dataValidate(filter_input(INPUT_POST, 'firstname'));
        $lastname = $this->dataValidate(filter_input(INPUT_POST, 'lastname'));
        $password = $this->dataValidate(filter_input(INPUT_POST, 'password'));  
        $role = $this->dataValidate(filter_input(INPUT_POST, 'role'));
        $status = $this->dataValidate(filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT));
  
        if ($id == null) {
            //It is a new user
            $request = 'insert';
            $user = new User();
        } else {
            //it is an update
            $request = 'update';
            $user = User::find($id, 'user');
        }

        $email = $this->checkValue($user->setEmail($email),"email", "merci de saisir un email valide");
        $firstname = $this->checkValue($user->setFirstname($firstname),"firstname", "le champ est obligatoire");
        $lastname = $this->checkValue($user->setLastname($lastname),"lastname", "le champ est obligatoire");
        $password = $this->checkValue($user->setPassword($password),"password", "merci de saisir un mot de passe valide : 8 caractères / 1 lettre minuscule / 1 lettre majuscule / un chiffre /  et un caractère spécial");
        $role = $this->checkValue($user->setRole($role),"role", "la sélection est obligatoire");
        $status = $this->checkValue($user->setStatus($status),"status", "la sélection est obligatoire");
        
        //if not empty, there are errors
        if (!empty($_SESSION['errors'])){

            $token = $this->generateToken();

            $this->show('back/user/add', [$_SESSION['errors'], 'user'=>$user, 'token'=>$token, 'type'=>'user']);
        } else{
            
            if ($user->$request()) {
               
                //it is ok, redirection with a success message
                ($request == 'insert')?$this->addFlashInfo("l'ajout a bien été effectué"):$this->addFlashInfo("la modification a bien été effectuée");
                $this->redirect('user-list');
                exit;
                
            }else{
                // not ok, redirection with error message
                $this->addFlashInfo("la requête a échouée");
                $this->redirect('user-list');
                exit;
            }
        }
    }
    public function delete($id){
        $user = User::find($id,'user');
        
        if ($user->delete()) {
               
            $this->addFlashInfo("la suppression a bien été effectuée");
            $this->redirect('user-list');
            exit;
            
        }else{
          
            $this->addFlashInfo("la requête a échouée");
            $this->redirect('user-list');
            exit;
        }
    }
}