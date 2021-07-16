<?php

namespace App\Entities;


class Movie {

    private $id;
    private $name;
    private $production_start_date;
    private $production_end_date;
    private $release_date;
    private $generated_income;
    
    

    public function __construct(array $data){

        $this->setName(htmlspecialchars($data['name']));
        $this->setProduction_start_date(htmlspecialchars($data['production_start_date']));
        $this->setProduction_end_date(htmlspecialchars($data['production_end_date']));
        $this->setRelease_date(htmlspecialchars($data['release_date']));
        $this->setGenerated_income(htmlspecialchars($data['generated_income']));
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
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of production_start_date
     */ 
    public function getProduction_start_date()
    {
        return $this->production_start_date;
    }

    /**
     * Set the value of production_start_date
     *
     * @return  self
     */ 
    public function setProduction_start_date($production_start_date)
    {
        $this->production_start_date = $production_start_date;

        return $this;
    }

    /**
     * Get the value of production_end_date
     */ 
    public function getProduction_end_date()
    {
        return $this->production_end_date;
    }

    /**
     * Set the value of production_end_date
     *
     * @return  self
     */ 
    public function setProduction_end_date($production_end_date)
    {
        $this->production_end_date = $production_end_date;

        return $this;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * Get the value of generated_income
     */ 
    public function getGenerated_income()
    {
        return $this->generated_income;
    }

    /**
     * Set the value of generated_income
     *
     * @return  self
     */ 
    public function setGenerated_income($generated_income)
    {
        $this->generated_income = (int)$generated_income;

        return $this;
    }
}