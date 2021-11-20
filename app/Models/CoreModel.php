<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

abstract class  CoreModel {
    protected $id;
    protected $name;
    protected $updated_at;
    protected $creaded_at;

    abstract protected function insert();
    abstract protected function update();
    abstract protected function delete();

    public static function all($nameTable){
        

        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `'.$nameTable.'`';
        
        $pdoStatement = $pdo->query($sql);
        
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, get_called_class());
        
        return $results;
    }

    public static function find($id, $nameTable){
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `'.$nameTable.'` WHERE `id` = '. $id;

        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchObject(get_called_class());
        return $results;
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

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return htmlspecialchars_decode($this->name);
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        if (strlen($name) >= 3){
            $this->name = $name;
            return $this->name;
        }else {
            return false;
        }
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of creaded_at
     */ 
    public function getCreadedAt()
    {
        return $this->creaded_at;
    }

    /**
     * Set the value of creaded_at
     *
     * @return  self
     */ 
    public function setCreadedAt($creaded_at)
    {
        $this->creaded_at = $creaded_at;

        return $this;
    }
}