# software_exercice <br/>
STEPS FOR LAUNCHING THE PROJECT <br/>
1-Download the mysql file et import in your mysql database <br/>
2-Clone the project <br/>
3-Rename the file "app/config/config-example.php" to "app/config.php" and enter your own environment <br/>
4-Rename the file "app/Tests/UserServiceTest-example.php" to "UserService.php" and define the variables of environment<br/>
5-Launch the programm with the command line "php -S localhost:5000 -t public/"<br/>
6-Test the "UserService" class with the command line "vendor/bin/phpunit ./app/Tests --color"
