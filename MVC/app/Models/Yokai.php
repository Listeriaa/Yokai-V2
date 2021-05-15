<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
class Yokai
{
    private $id;
    private $name;
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
        $yokai = false;
        
        while ($yokai == false) {
            $pdo = Database::getPDO();
            //selection d'une ligne aléatoire
            $sql = "SELECT *
            FROM `yokais`
            WHERE RAND() > 0.9
            ORDER BY RAND( )
            LIMIT 1";
            $pdoStatement = $pdo->query($sql);
            $character = $pdoStatement->fetchObject(self::class);
        }
        return $character;
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

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}