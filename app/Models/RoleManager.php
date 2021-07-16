<?php

namespace App\Models;

use PDO;
use App\Libraries\Database;

class RoleManager {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getIdByRoleName($roleName){
        $this->db->query('SELECT id FROM role WHERE name = :name');
        $this->db->bind(':name', $roleName, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateRole($role)
    {
        $this->db->query('UPDATE role SET fixe_income = :fixe_income, percentage = :percentage where name = :name');
        $this->db->bind(':name',$role->getName(),PDO::PARAM_INT);
        $this->db->bind(':fixe_income',$role->getFixe_income(),PDO::PARAM_STR);
        $this->db->bind(':percentage',$role->getPercentage(),PDO::PARAM_STR);
        $this->db->execute();
    }


    public function checkRole($id){
        $this->db->query('SELECT id FROM role WHERE id = :id');
        $this->db->bind(':id',$id,PDO::PARAM_INT);
        return $this->db->resultBool();
    }

    public function checkRoleByName($roleName){
        $this->db->query('SELECT id FROM role WHERE name = :name');
        $this->db->bind(':name',$roleName,PDO::PARAM_STR);
        return $this->db->resultBool();
    }

    public function getAllRoles(){
        $this->db->query('SELECT * FROM role');
        return $this->db->resultSetObj();
    }

    public function deleteRole($id){
        $this->db->query('DELETE FROM role WHERE id = :id ');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();

    }

}