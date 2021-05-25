<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

abstract class  CoreModel {
    protected $id;
    protected $name;
    protected $updated_at;
    protected $creaded_at;

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

    abstract protected function insert();
    abstract protected function update();
    
    abstract protected function delete();



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