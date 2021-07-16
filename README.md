# software_exercice <br/>
STEPS FOR LAUNCHING THE PROJECT <br/>
1-Download the mysql file et import in your mysql database <br/>
2-Clone the project <br/>
3-Make a "composer install" for installing the dependencies <br/>
4-Rename the file "app/config/config-example.php" to "app/config.php" and enter your own environment <br/>
5-Rename the file "app/Tests/UserServiceTest-example.php" to "UserService.php" and define the variables of environment<br/>
6-Launch the programm with the command line "php -S localhost:5000 -t public/"<br/>
7-Test the "UserService" class with the command line "vendor/bin/phpunit ./app/Tests --color"

# THE PROJECT
You have been asked to create an application for calculating the monthly remittance due to staff who work for<br/>
a film production company.<br/>
The way in which each month's pay is calculated depends on the employee's role and individual contract<br/>
terms, both of which can vary for each film produced, and each employee may hold more than one role for a<br/>
given film.<br/><br/>
For example:<br/>
• An actor receives a fixed fee for appearing in a film, which is spread evenly over the expected duration of<br/>
filming. They may also receive a percentage share of revenue generated, for the previous month, by one<br/>
or more films they have previously appeared in.<br/>
• Production staff (eg lighting crew) only ever receive a fixed monthly amount.<br/>
• Senior production staff (eg director, producer) are always paid a monthly fee during film production<br/>
(which continues after filming), plus an ongoing percentage of monthly revenue generated.<br/>
• On occasion, an actor may also be a director or producer, for example.<br/>
Please note it should be possible to retrieve historical records for any given month and/or employee, so that<br/>
calculations can be checked retrospectively.<br/>
Please complete the following tasks:<br/>
1. Create an entity relationship diagram to represent the database tables and fields that could be used<br/>
to store this information.<br/>
2. Create a separate entity relationship diagram to represent the classes and method signatures you<br/>
would use to model and serve this data.<br/>
3. Write a method that, given a year, month and employee ID, will calculate the amount (if any) owed to<br/>
that employee for that month.

