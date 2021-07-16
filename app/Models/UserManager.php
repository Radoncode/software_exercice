<?php

namespace App\Models;

use PDO;
use App\Libraries\Database;


class UserManager {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser($staff){
        $this->db->query('INSERT INTO staff( name, employeeID)
                          VALUES( :name, :employeeID)');
        $this->db->bind(':name',$staff->getName(),PDO::PARAM_STR);
        $this->db->bind(':employeeID',$staff->getEmployeeID(),PDO::PARAM_STR);
        $this->db->execute();
    }


    public function getAllUsersWithRolesAndMovies(){
        $this->db->query('SELECT *,m.name FROM staff as s 
                            RIGHT JOIN role as r ON s.role_id = r.id 
                                RIGHT JOIN movie as m ON s.movie_id = m.id');
        return $this->db->resultSetObj();
    }

    public function checkUser($id){
        $this->db->query('SELECT id FROM staff WHERE id = :id');
        $this->db->bind(':id',$id,PDO::PARAM_INT);
        return $this->db->resultBool();
    }

    public function checkUserByEmployeeID($employeeID){
        $this->db->query('SELECT id FROM staff WHERE employeeID = :employeeID');
        $this->db->bind(':employeeID',$employeeID,PDO::PARAM_STR);
        return $this->db->resultBool();
    }

    public function checkMovieByEmployeeID($employeeID, $nameMovie){
        $this->db->query('SELECT movie_id FROM staff WHERE employeeID = :employeeID AND movie_id = :movie_id ');
        $this->db->bind(':employeeID',$employeeID,PDO::PARAM_STR);
        $this->db->bind(':movie_id',$nameMovie,PDO::PARAM_STR);
        return $this->db->resultBool();
    }

    public function deleteUser($id){
        $this->db->query('DELETE FROM staff WHERE id = :id ');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();

    }

    public function getIdByEmployeeID($employeeID){
        $this->db->query('SELECT id FROM staff WHERE employeeID = :employeeID');
        $this->db->bind(':employeeID', $employeeID, PDO::PARAM_INT);
        return $this->db->resultSetObj();
    }
    
    public function getAllRoles($employeeID){
        $this->db->query('SELECT role_id FROM staff WHERE employeeID = :employeeID');
        $this->db->bind(':employeeID', $employeeID, PDO::PARAM_STR);
        return $this->db->resultSetAssoc();
    }

    public function addMovieAndRole($nameMovie,$nameRole,$employeeID)
    {   
        $this->db->query('INSERT INTO staff(employeeID, role_id, movie_id)
                          VALUES(:employeeID, :role_id, :movie_id)');
        $this->db->bind(':employeeID',$employeeID,PDO::PARAM_STR);
        $this->db->bind(':role_id',$nameRole,PDO::PARAM_STR);
        $this->db->bind(':movie_id',$nameMovie,PDO::PARAM_STR);
        $this->db->execute();
        
    }

    public function updateEmployeeId($nameMovie,$nameRole,$employeeID)
    {   
        $this->db->query('UPDATE staff SET role_id = :role_id, movie_id = :movie_id WHERE employeeID = :employeeID');
        $this->db->bind(':employeeID',$employeeID,PDO::PARAM_STR);
        $this->db->bind(':role_id',$nameRole,PDO::PARAM_STR);
        $this->db->bind(':movie_id',$$nameMovie,PDO::PARAM_STR);
        $this->db->execute();
        
    }


    public function getShootingDurationByYearAndMonth($monthDate, $yearDate, $roleID, $employeeID){
        $this->db->query("SELECT m.production_start_date, m.production_end_date,m.generated_income, r.fixe_income, r.percentage
                            FROM staff s
                                 LEFT JOIN role as r ON s.role_id = r.id 
                                    LEFT JOIN movie as m ON s.movie_id = m.id
                                     WHERE s.role_id = :role_id   
                                        AND s.employeeID = :employeeID
                                            AND ((MONTH(m.production_start_date) = :monthDate
                                                AND YEAR(m.production_start_date) = :yearDate)
                                                    OR (MONTH(m.production_end_date) = :monthDate
                                                        AND YEAR(m.production_end_date) = :yearDate))"
                        );
        $this->db->bind(':role_id', $roleID, PDO::PARAM_INT);
        $this->db->bind(':employeeID', $employeeID, PDO::PARAM_STR);
        $this->db->bind(':monthDate', $monthDate, PDO::PARAM_INT);
        $this->db->bind(':yearDate', $yearDate, PDO::PARAM_INT);
        return $this->db->resultSetAssoc();
    }

    public function getShootingDurationByYearAndMonthExceptCurrentMonth($monthDate, $yearDate,$roleID, $employeeID){
        $this->db->query("SELECT m.production_start_date, m.production_end_date,m.generated_income, r.fixe_income, r.percentage
                            FROM staff s
                                 LEFT JOIN role as r ON s.role_id = r.id 
                                    LEFT JOIN movie as m ON s.movie_id = m.id
                                     WHERE s.role_id = :role_id   
                                        AND s.employeeID = :employeeID
                                            AND ((MONTH(m.production_start_date) <> :monthDate
                                                AND YEAR(m.production_start_date) = :yearDate)
                                                    OR (MONTH(m.production_end_date) <> :monthDate
                                                        AND YEAR(m.production_end_date) = :yearDate))"
                        );
        $this->db->bind(':role_id', $roleID, PDO::PARAM_INT);
        $this->db->bind(':employeeID', $employeeID, PDO::PARAM_STR);
        $this->db->bind(':monthDate', $monthDate, PDO::PARAM_INT);
        $this->db->bind(':yearDate', $yearDate, PDO::PARAM_INT);
        return $this->db->resultSetAssoc();
    }

}