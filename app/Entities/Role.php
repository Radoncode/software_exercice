<?php

namespace App\Entities;

use Exception;

class Role {

    private $id;
    private $name;
    private $fixe_income;
    private $percentage;

    public function __construct(array $data){

        $this->setName(htmlspecialchars($data['name']));
        $this->setFixe_income(htmlspecialchars($data['fixe_income']));
        $this->setPercentage(htmlspecialchars($data['percentage']));
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
        $this->name = (int)$name;

        return $this;
    }

    /**
     * Get the value of fixe_income
     */ 
    public function getFixe_income()
    {
        return $this->fixe_income;
    }

    /**
     * Set the value of fixe_income
     *
     * @return  self
     */ 
    public function setFixe_income($fixe_income)
    {   
        $this->fixe_income = (int)$fixe_income;

        return $this;
    }

    /**
     * Get the value of percentage
     */ 
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set the value of percentage
     *
     * @return  self
     */ 
    public function setPercentage($percentage)
    {   
        if($percentage > 0 && $percentage <= 100 ){
            $this->percentage = (int)$percentage;
        } else {
            throw new Exception('this value is not included between 0 and 100 ');
        }
        

        return $this;
    }
}