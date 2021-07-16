<?php

namespace App\Services;

use DateTime;
use Exception;
use App\Entities\Staff;
use App\Models\UserManager;
 

class UserService {

    private $userManager;
    private $staffID;
    private $salary = NULL;
    private $employeeID;
    private const ACTOR = 1;
    private const PERSONAL_PRODUCTION = 2;
    private const PERSONAL_PRODUCTION_SENIOR= 3;

    public function __construct() {
        $this->userManager = new UserManager();
    }
    
    /**
     * Get the salary of the employee for a month and a year given
     */
    public function getAmountSalaryEmployee($employeeID, $month, $year) { 

        $this->employeeID = $employeeID;    
        $this->staffID = $this->userManager->getIdByEmployeeID($employeeID);
       
        //we retrieve an object unique array of all the roles for the employee
        $arrayRoles = $this->userManager->getallRoles($employeeID);
        $arrayRole = [];
        foreach ($arrayRoles as $value){
            $arrayRole[] = $value["role_id"];
        }
        $arrayRole = array_unique($arrayRole);

        //Doing a loop and a switch with all the role played by this employee 
        foreach ($arrayRole as $value){
            switch($value){
                case self::ACTOR:
                    $this->salary += $this->calculSalaryForActorByMonthAndYear($month, $year);
                    break;
                case self::PERSONAL_PRODUCTION:
                    $this->salary += $this->calculSalaryForPersonalProductionByMonthAndYear($month, $year);
                    break;
                case self::PERSONAL_PRODUCTION_SENIOR;
                $this->salary += $this->calculSalaryForPersonalProductionSeniorByMonthAndYear($month, $year);
                    break;
                default;
                    throw new Exception("Don't find any roles for this employee");

            }
        }
        return $this->salary;
    }
    
    /**
     * Calcul the salary for an actor with month and year provided
     */
    public function calculSalaryForActorByMonthAndYear($month, $year){

        //Retrieving the dates of the shooting
        $arrayShooting = $this->userManager->getShootingDurationByYearAndMonth($month, $year, self::ACTOR, $this->employeeID);

        $salary = null;
        foreach($arrayShooting as $shooting){
             
            // Creation DateTime object for the start date shooting and end date shooting
            $startDateShooting = new DateTime($shooting['production_start_date']);
            $endDateShooting = new DateTime($shooting['production_end_date']);
            
            // transform the date in duration in days
            $shootingDuration = ($startDateShooting->diff($endDateShooting))->format('%d');

            // Multiplication the duration by the income
            $salary += $shooting['fixe_income'] * (int)$shootingDuration;

            //check if he played the last month
            $playedLastMonth= $this->userManager->getShootingDurationByYearAndMonth($month-1, $year, self::ACTOR, $this->employeeID);
            
            if(!empty($playedLastMonth)){

                // calcul the salary with the percentage of the generated income
                foreach($playedLastMonth as $played){
                    $salary = $salary + ($played['generated_income'] * ($played['percentage'] / 100));
                }                
            }
        }
        return $salary;  
    }

    /**
     * Calcul the salary for a personal production  with month and year provided
     */
    public function calculSalaryForPersonalProductionByMonthAndYear($month, $year){

        //Retrieving the dates of the shooting
        $arrayShooting = $this->userManager->getShootingDurationByYearAndMonth($month, $year, self::PERSONAL_PRODUCTION, $this->employeeID);

        $salary = null;
        foreach($arrayShooting as $shooting){
             
            // Creation DateTime object for the start date shooting and end date shooting
            $startDateShooting = new DateTime($shooting['production_start_date']);
            $endDateShooting = new DateTime($shooting['production_end_date']);
            
            // transform the date in duration in days
            $shootingDuration = ($startDateShooting->diff($endDateShooting))->format('%d');

            //Multiplication the duration by the income of the month
            $salary += $shooting['fixe_income'] * (int)$shootingDuration;
            
        }
        return $salary; 
    }

    /**
     * Calcul the salary for a personal production senior with month and year provided
     */
    public function calculSalaryForPersonalProductionSeniorByMonthAndYear($month, $year){
        
        //Retrieving the dates of the shooting
        $arrayShooting = $this->userManager->getShootingDurationByYearAndMonth($month, $year, self::PERSONAL_PRODUCTION_SENIOR, $this->employeeID);

        $salary = null;
        foreach($arrayShooting as $shooting){
             
            // Creation DateTime object for the start date shooting and end date shooting
            $startDateShooting = new DateTime($shooting['production_start_date']);
            $endDateShooting = new DateTime($shooting['production_end_date']);
            
            // transform the date in duration in days
            $shootingDuration = ($startDateShooting->diff($endDateShooting))->format('%d');

            // Multiplication the duration by the income of the month
            $salary += $shooting['fixe_income'] * (int)$shootingDuration;
            /**
             * Check if the personal production senior has played in previous movies except the current month and
             * add fixe income of this month and percentage of the generated revenue for this movie
             * */ 
            $playedOtherMonth= $this->userManager->getTest($month, $year, self::PERSONAL_PRODUCTION_SENIOR, $this->employeeID);
            if($playedOtherMonth){
                foreach($playedLastMonth as $value){
                   $salary = $salary + $played['fixe_income'] + ($played['generated_income'] * ($played['percentage'] / 100));
                }
            }
        }
        return $salary;
    }
}