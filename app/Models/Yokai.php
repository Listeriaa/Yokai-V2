<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Yokai extends CoreModel
{

    private $kanji;
    private $picture;
    private $translation;
    private $habitat;
    private $appearance;
    private $origin;
    private $behavior;
    private $alt;


    public static function getRandomYokai(){
        
        $pdo = Database::getPDO();
        $sql = 'SELECT `id` FROM `yokai`';
        $pdoStatement = $pdo->query($sql);
        $arrayId = $pdoStatement->fetchAll(PDO::FETCH_COLUMN);

        
        $id = $arrayId[array_rand($arrayId, 1)];

        
        $sql = 'SELECT * FROM `yokai` WHERE `id` = '. $id;
        $pdoStatement = $pdo->query($sql);
        
        
        $yokai = $pdoStatement->fetchObject(self::class);
        return $yokai;
    }

    public static function getYokaiById($id){
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `yokai` WHERE `id` = '. $id;

        $pdoStatement = $pdo->query($sql);

        $yokai = $pdoStatement->fetchObject(self::class);

        return $yokai;
    }

 
    public function insert(){
        $pdo = Database::getPDO();

        $sql = "
        INSERT INTO `yokai` (name, kanji, picture, translation, habitat, appearance, origin, behavior, alt)
        VALUES (:name, :kanji, :picture, :translation, :habitat, :appearance, NULLIF(:origin, ''), :behavior, :alt)
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
        $pdoStatement->bindValue(':alt', $this->alt);

        $done = $pdoStatement->execute();

        if($done) {
            
            $this->id = $pdo->lastInsertId();
        }
        return $done;
    }

    public function update(){
        $pdo = Database::getPDO();
        
       
        $sql = "
            UPDATE `yokai`
            SET name = :name, kanji = :kanji, picture = :picture, translation = :translation, habitat = :habitat, appearance = :appearance, origin=NULLIF(:origin, ''), behavior = :behavior, alt= :alt, updated_at = NOW()
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
        $pdoStatement->bindValue(':alt', $this->alt);
        $pdoStatement->bindValue(':id', $this->id);
        
        return $pdoStatement->execute();
    }

    public function delete(){
        $pdo = Database::getPDO();
        $sql = "DELETE FROM `yokai`
        WHERE `id` = :id";

        
        $pdoStatement = $pdo->prepare($sql);

        

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
        return htmlspecialchars_decode($this->kanji);
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

    /**
     * Get the value of alt
     */ 
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set the value of alt
     *
     * @return  self
     */ 
    public function setAlt($alt)
    {
        if (strlen($alt) >= 1){
            $this->alt = $alt;
            return $this->alt;
        }else {
            return false;
        }
    }
}