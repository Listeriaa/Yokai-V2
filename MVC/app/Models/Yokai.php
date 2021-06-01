<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
class Yokai extends CoreModel
{

    private $kanji;
    private $picture;
    private $translation;
    private $habitat;
    private $appearance;
    private $origin;
    private $behavior;


//     et pour le tableClass tu as des fonctions php qui te permettent d'avoir la classe de l'objet en cours (ou de la classe qui appelle la fonction si on est en static)
// c'est get_class et get_called_class
    public static function getRandomYokai(){
        //je sélectionne tous les id des yokai
        $pdo = Database::getPDO();
        $sql = 'SELECT `id` FROM `yokais`';
        $pdoStatement = $pdo->query($sql);
        $arrayId = $pdoStatement->fetchAll(PDO::FETCH_COLUMN);

        //je choisis une clé du tableau au hasard et je récupère sa valeur c'est à dire une id existante (présente dans la bdd)
        $id = $arrayId[array_rand($arrayId, 1)];

        //je récupère le yokai correspondant à cette id
        $sql = 'SELECT * FROM `yokais` WHERE `id` = '. $id;
        $pdoStatement = $pdo->query($sql);
        
        //je retourne l'objet Yokai correspondant
        $yokai = $pdoStatement->fetchObject(self::class);
        return $yokai;
    }

    public static function getYokaiById($id){
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `yokais` WHERE `id` = '. $id;

        $pdoStatement = $pdo->query($sql);

        $yokai = $pdoStatement->fetchObject(self::class);

        return $yokai;
    }

 
    public function insert(){
        $pdo = Database::getPDO();

        $sql = "
        INSERT INTO `yokais` (name, kanji, picture, translation, habitat, appearance, origin, behavior)
        VALUES (:name, :kanji, :picture, :translation, :habitat, :appearance, NULLIF(:origin, ''), :behavior)
    ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->name);
        $pdoStatement->bindValue(':kanji', $this->kanji);
        $pdoStatement->bindValue(':picture', $this->picture);
        $pdoStatement->bindValue(':translation', $this->translation);
        $pdoStatement->bindValue(':habitat', $this->habitat);
        $pdoStatement->bindValue(':appearance', $this->appearance);
        $pdoStatement->bindValue(':origin', $this->origin);
        $pdoStatement->bindValue(':behavior', $this->behavior);

        $done = $pdoStatement->execute();

        if($done) {
            // si tout s'est bien passé on va renseigner l'identifiant généré par la BDD dans la propriété de l'objet
            // la propriété id est définit dans le CoreModel !
            $this->id = $pdo->lastInsertId();
        }
        return $done;
    }

    public function update(){
        $pdo = Database::getPDO();
        
        // Ecriture de la requête INSERT INTO
        $sql = "
            UPDATE `yokais`
            SET name = :name, kanji = :kanji, picture = :picture, translation = :translation, habitat = :habitat, appearance = :appearance, origin=NULLIF(:origin, ''), behavior = :behavior, updated_at = NOW()
            WHERE id=:id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->name);
        $pdoStatement->bindValue(':kanji', $this->kanji);
        $pdoStatement->bindValue(':picture', $this->picture);
        $pdoStatement->bindValue(':translation', $this->translation);
        $pdoStatement->bindValue(':habitat', $this->habitat);
        $pdoStatement->bindValue(':appearance', $this->appearance);
        $pdoStatement->bindValue(':origin', $this->origin);
        $pdoStatement->bindValue(':behavior', $this->behavior);
        $pdoStatement->bindValue(':id', $this->id);
        
        return $pdoStatement->execute();
    }

    public function delete(){
        $pdo = Database::getPDO();
        $sql = "DELETE FROM `yokais`
        WHERE `id` = :id";

        // Pour éviter les injections SQL on va utiliser la méthode prepare de PDO
        $pdoStatement = $pdo->prepare($sql);

        // bindValue associe une valeur à un paramètre

        $pdoStatement->bindValue(':id', $this->id);

        return $pdoStatement->execute();
    }
    /**
     * Get the value of behavior
     */ 
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set the value of behavior
     *
     * @return  self
     */ 
    public function setBehavior($behavior)
    {
        if (strlen($behavior) >= 50){
            $this->behavior = $behavior;
            return $this->behavior;
        }else {
            return false;
        }
    }

    /**
     * Get the value of origin
     */ 
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set the value of origin
     *
     * @return  self
     */ 
    public function setOrigin($origin)
    {
        if ($origin ==='' || strlen($origin) >= 20){
            $this->origin = $origin;
            return $this->origin;
        }else {
            return false;
        }
    }

    /**
     * Get the value of appearance
     */ 
    public function getAppearance()
    {
        return $this->appearance;
    }

    /**
     * Set the value of appearance
     *
     * @return  self
     */ 
    public function setAppearance($appearance)
    {
        if (strlen($appearance) >= 50){
            $this->appearance = $appearance;
            return $this->appearance;
        }else {
            return false;
        }
    }

    /**
     * Get the value of habitat
     */ 
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set the value of habitat
     *
     * @return  self
     */ 
    public function setHabitat($habitat)
    {
        if (strlen($habitat) >= 5){
            $this->habitat = $habitat;
            return $this->habitat;
        }else {
            return false;
        }
    }

    /**
     * Get the value of translation
     */ 
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set the value of translation
     *
     * @return  self
     */ 
    public function setTranslation($translation)
    {
        if (strlen($translation) >= 5){
            $this->translation = $translation;
            return $this->translation;
        }else {
            return false;
        }
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $regex = "#\.jpg|\.png$#";
        if(preg_match($regex, $picture)===1){
            $imgregex = "#^images\/#";
            if (preg_match($imgregex, $picture)===1){
                $this->picture = $picture;
                return $this->picture;
            }
            else {
                $picture = "images/".$picture;
                $this->picture = $picture;
                return $this->picture;
            }
        } else {
            return false;
        }
    }

    /**
     * Get the value of kanji
     */ 
    public function getKanji()
    {
        return $this->kanji;
    }

    /**
     * Set the value of kanji
     *
     * @return  self
     */ 
    public function setKanji($kanji)
    {
        if (strlen($kanji) >= 1){
            $this->kanji = $kanji;
            return $this->kanji;
        }else {
            return false;
        }
    }


}