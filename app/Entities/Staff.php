<?php

namespace App\Entities;


class Staff {

    private $id;
    private $employeeID;
    private $movie_id;

    public function __construct ($data){
        $this->setEmployeeID(htmlspecialchars($data['employeeID']));
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of employeeID
     */ 
    public function getEmployeeID()
    {
        return $this->employeeID;
    }

    /**
     * Set the value of employeeID
     *
     * @return  self
     */ 
    public function setEmployeeID($employeeID)
    {
        $this->employeeID = $employeeID;

        return $this;
    }

    /**
     * Get the value of movie_id
     */ 
    public function getMovie_id()
    {
        return $this->movie_id;
    }
}