<?php
namespace App\Tests;
use App\Models\UserManager;
use App\Services\UserService;
use PHPUnit\Framework\TestCase;

define('DB_HOST', 'YOUR_HOST_HERE');
define('DB_USER', 'YOUR_USER_HERE');
define('DB_PASS','YOUR_PASS_HERE');
define('DB_NAME', 'YOUR_DB_NAME_HERE');

class UserServiceTest extends TestCase
{   

      /**
       * Test If I get a salary with 
       * employeeID = 'GH8956'
       * month = '7'
       * year = '2021'
       * expected generated revenue = 89000
       * movie = batman
       * role = actor
       * actor fixe income by day = 80
       * actor percentage = 25
       * no staff production
       * no staff production senior
       */
      public function testGetAmountSalaryEmployee()
      {
          $userService = new UserService();
          $result = $userService->getAmountSalaryEmployee('GH8956',7, 2021);      
          $this->assertSame(640, $result);

      }

}