<?php
namespace App\Controllers;
use DateTime;
use App\Router;
use App\Entities\Role;
use App\Entities\Movie;
use App\Entities\Staff;
use App\Models\RoleManager;
use App\Models\UserManager;
use App\Models\MovieManager;
use App\Libraries\Controller;
use App\Services\UserService;

class HomeController extends Controller {

    private $userService;
    private $router;
    private $userManager;
    private $movieManager; 
    private $roleManager;

    
    public function __construct()
    {   
        $this->userService = new UserService();
        $this->userManager = new UserManager();
        $this->movieManager = new MovieManager();
        $this->roleManager = new RoleManager();
        
    }
    
    /**
     * Create a menber of the staff
     */
    public function userForm(array $data){
        $staffer = new Staff($data);
        $this->userManager->createUser($staffer);
        header('Location:'.URLROOT);
        exit;
        
    }
    /**
     * Create a movie
     */
    public function movieForm(array $data){
        $movie = new Movie($data);
        if($movie->getProduction_start_date() < $movie->getProduction_end_date()
            && $movie->getRelease_date() > $movie->getProduction_start_date()
            && $movie->getRelease_date() > $movie->getProduction_end_date()){
                $this->movieManager->createMovie($movie);
                header('Location:'.URLROOT);
                exit;
            } else {
                header('Location:'.URLROOT);
                exit;
            }
    }

    /**
     * Create a role
     */
    public function roleForm(array $data){

        $role = new Role($data);
        $roleName = (int)$role->getName();

        // check if this role exists
        $nameArray = [1,2,3];
        $roleExist = in_array($roleName, $nameArray);
        if($roleExist){
            $this->roleManager->updateRole($role);
            header('Location:'.URLROOT);
            exit;
        } else {
            header('Location:'.URLROOT);
            exit;
        }
    }

    /**
     * Affect a role and a movie to a member of the staff
     */
    public function affectationForm(array $data){

        $employeeID = htmlspecialchars($data['employeeID']);
        $nameMovie = htmlspecialchars($data['nameMovie']);
        $nameRole = htmlspecialchars($data['nameRole']);

        $existNameMovie = $this->movieManager->checkMovie($nameMovie);
        $existNameRole = $this->roleManager->checkRoleByName($nameRole);

        

        if ($existNameMovie && $existNameRole){

            //check  if he has already played in the movie
            $alreadyPlay = $this->userManager->checkMovieByEmployeeID($employeeID, $nameMovie);
            
            if (!$alreadyPlay){
                $this->userManager->addMovieAndRole($nameMovie,$nameRole,$employeeID);
                header('Location:'.URLROOT);
                exit;
            } else {
                header('Location:'.URLROOT);
                exit;
            }            
        } else {
            header('Location:'.URLROOT);
            exit;
        }
    }

    /**
     * Retrieve all the menbers of the staff
     */
    public function getAllStaffers(){

        $users = $this->userManager->getAllUsersWithRolesAndMovies();

        if ($users){
            return $users;
        } else {
            return null;
        }
    }
    /**
     * * Retrieve all the movies
     */
    
   public function getAllMovies(){

       $movies = $this->movieManager->getAllMovies();
       if ($movies){
           return $movies;
       } else {
           return null;
       }
    }

    /**
     * * Retrieve all the roles
     */
    
   public function getAllRoles(){

        $roles = $this->roleManager->getAllRoles();
        if ($roles){
            return $roles;
        } else {
            return null;
        }
    }
    /**
     * Delete a movie
     */
    public function deleteMovie($id){

        $movieId = (int)$id;

        // check if the movieId exist
        $movieExist = $this->movieManager->checkMovie($movieId);
        if ($movieExist){
            $this->movieManager->deleteMovie($movieId);
            header('Location:'.URLROOT);
            exit;
        } else {
            header('Location:'.URLROOT);
            exit;
        }
    }

    /**
     * Delete a menber of the staff
     */
    public function deleteStaff($id){

        $staffId = (int)$id;

        // check if the staffId exist
        $staffExist = $this->userManager->checkUser($staffId);
        if ($staffExist){
            $this->userManager->deleteUser($staffId);
            header('Location:'.URLROOT);
            exit;
        } else {
            header('Location:'.URLROOT);
            exit;
        }
    }

    /**
     * Delete a role
     */
    public function deleteRole($id){

        $roleId = (int)$id;

        // check if the roleId exist
        $roleExist = $this->roleManager->checkRole($roleId);
        
        if ($roleExist){
            $this->roleManager->deleteRole($roleId);
            header('Location:'.URLROOT);
            exit;
        } else {
            header('Location:'.URLROOT);
            exit;
        }
    }

    

    public function calculAmount (array $data)
    {   

        $employeeID = htmlspecialchars($data['employeeID']);
        $salaryDate = htmlspecialchars($data['salary_date']);

        $month = (int)(new DateTime($salaryDate))->format('m');
        $year = (int)(new DateTime($salaryDate))->format('Y');

        $existEmployeeID = $this->userManager->checkUserByEmployeeID($employeeID);

        if ($existEmployeeID){           
        $amount = $this->userService->getAmountSalaryEmployee($employeeID, $month, $year);
        return $amount;
        header('Location:'.URLROOT);
        exit;
        } else {
            return null;
            header('Location:'.URLROOT);
            exit;
        }
    }
}

