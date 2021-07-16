<?php

namespace App\Models;

use App\Libraries\Database;
use PDO;

class MovieManager {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createMovie($data){
        $this->db->query('INSERT INTO movie( name, production_start_date,
                                             production_end_date,
                                             release_date,
                                             generated_income)
                          VALUES( :name, :production_start_date,
                                             :production_end_date,
                                             :release_date,
                                             :generated_income)');
        $this->db->bind(':name',$data->getName(),PDO::PARAM_STR);
        $this->db->bind(':production_start_date',$data->getProduction_start_date(),PDO::PARAM_STR);
        $this->db->bind(':production_end_date',$data->getProduction_end_date(),PDO::PARAM_STR);
        $this->db->bind(':release_date',$data->getRelease_date(),PDO::PARAM_STR);
        $this->db->bind(':generated_income',$data->getGenerated_income(),PDO::PARAM_INT);
        $this->db->execute();
    }

    public function getAllMovies(){
        $this->db->query('SELECT * FROM movie');
        return $this->db->resultSetObj();
    }

    public function checkMovie($id){
        $this->db->query('SELECT id FROM movie WHERE id = :id');
        $this->db->bind(':id',$id,PDO::PARAM_INT);
        return $this->db->resultBool();
    }

    public function deleteMovie($id){
        $this->db->query('DELETE FROM movie WHERE id = :id ');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();

    }
}