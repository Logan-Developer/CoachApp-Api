# CoachApp-Api
Api for a fictive coaching app.

## Init project
Start by cloning the project: https://github.com/Logan-Developer/CoachApp-Api.git  
Then update the composer dependencies by executing the command __composer update__  
Finally, the command __symfony console lexik:jwt:generate-keypair__ will generate for you the jwt keys.

## Configure the database
Open the *.env* file and modify the __DATABASE_URL__ variable if needed.  
You can then create the database with the command __symfony console doctrine:database:create__  
then the command __symfony console make:migration__ to create a migration.  
The command __symfony console doctrine:migrations:migrate__ will let you executing the migration.

## Populate the database
You can populate the database with data using the provided fixtures with the command __symfony console doctrine:fixtures:load__  
If you use the fixtures, two users are provided:  
* A normal user with login __user__ and password __secret__
* An admin with login __admin__ and password __secret__

## Start the server
You can start the symfony internal server using the command __symfony serve__
