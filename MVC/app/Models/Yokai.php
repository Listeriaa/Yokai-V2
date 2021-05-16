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
    
    public static function getAllYokai(){
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `yokais`';
        
        $pdoStatement = $pdo->query($sql);
        
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

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


    public function create(){

    }
    public function update(){
        
    }
    public function add(){
        
    }
    public function delete(){
        
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
        $this->behavior = $behavior;

        return $this;
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
        $this->origin = $origin;

        return $this;
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
        $this->appearance = $appearance;

        return $this;
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
        $this->habitat = $habitat;

        return $this;
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
        $this->translation = $translation;

        return $this;
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
        $this->picture = $picture;

        return $this;
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
        $this->kanji = $kanji;

        return $this;
    }


}