<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class User extends CoreModel{

    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    /**
     * method to check if a 
     *
     * @param string $email
     * @return void
     */
    public static function findByEmail(string $email){
        $pdo = Database::getPDO();
        
        $sql = 'SELECT * FROM `users` WHERE `email` = :email';

        $pdoStatement=$pdo->prepare($sql);

        $pdoStatement->execute([
            ':email'=>$email
        ]);
        
        $result = $pdoStatement->fetchObject(self::class);
        return $result;
        
    }

    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        $sql = "
        INSERT INTO `users` (email, password, lastname, firstname, role, status)
        VALUES (:email, :password, :lastname, :firstname, :role, :status)
        ";

        // Préparation de la requête pour protéger contre hack
        $pdoStatement=$pdo->prepare($sql);

        // Execution de la requête d'insertion (exec, pas query)
        // $insertedRows = $pdo->exec($pdoStatement);

        $insertedRows = $pdoStatement->execute([
            ':email' => $this->email,
            ':lastname' => $this->lastname,
            ':firstname' => $this->firstname,
            ':password' => $this->password,
            ':role' => $this->role,
            ':status' => $this->status

        ]);
        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }
    public function update(){
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "
            UPDATE `users`
            SET email =:email, password=:password, lastname=:lastname, firstname= :firstname,role= :role, status=:status, updated_at = NOW()
            WHERE id= :id
        ";

        $pdoStatement=$pdo->prepare($sql);

        // Execution de la requête d'insertion (exec, pas query)
        // $insertedRows = $pdo->exec($pdoStatement);

        $insertedRows = $pdoStatement->execute([
            ':email' => $this->email,
            ':lastname' => $this->lastname,
            ':firstname' => $this->firstname,
            ':password' => $this->password,
            ':role' => $this->role,
            ':status' => $this->status,
            ':id'=>$this->id
        ]);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }
    public function delete(){
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "
            DELETE FROM `users`
            WHERE id=:id
        ";

        $pdoStatement = $pdo->prepare($sql);

        // Execution de la requête de suppresion (exec, pas query)
        // On peut envoyer les données « brutes » à execute() qui va les "sanitize" pour SQL.
        $deletedRows = $pdoStatement->execute([
            ':id' => $this->id
        ]);
        // Si au moins une ligne ajoutée
        if ($deletedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
       if(!empty($email)){
           $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
           return $this->email;
       } else {
           return false;
       }
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $regex = "~^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$%_*|=&-])[A-Za-z\d@$%_*|=&-]{8,}$~";
        if ((preg_match($regex, $password)===1)){
            $this->password = password_hash($password, PASSWORD_DEFAULT);;
            return $this->password;
        }
        else{
            return false;
        }

    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        if(!empty($firstname)){
            $this->firstname = $firstname;
            return $this->firstname;
        } else {
            return false;
        }
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        if(!empty($lastname)){
            $this->lastname = $lastname;
            return $this->lastname;
        } else {
            return false;
        }
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        if(!empty($role)){
            $this->role = $role;
            return $this->role;
        } else {
            return false;
        }
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        if($status>=0 && $status <=2){
            $this->status = $status;
            return $this->status;
        } else {
            return false;
        }
    }
}