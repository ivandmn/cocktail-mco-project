## Installation

###Run the following commands to open laravel REST api as backend in "localhost":8000 (file "backend_laravel_api_mco_cocktail_project")
#####Install Dependencies and generate key
```bash 
composer install
```
```bash 
php artisan key:generate
```
##### Migrates all the tables and test data to the db
```bash 
php artisan migrate:fresh --seed
```
##### Open laravel in localhost with the next command
```bash 
php artisan serve
```

### Run the following commands to open Angular frontend in "localhost":4200 (fille "frontend_angular_mco_cocktail_project")
##### Required node.js && Angular installed

Install angular with the next command
```bash 
npm install -g @angular/cli
```
Open angular in loclhost with the next command
```bash 
ng serve --open
```


##Database
Database has the next tables ->
  - [Ingredients](#git) --> Save cocktail ingredients, the ingredients are from MCO API
  - [Users](#django) --> Save users info
  - [Orders](#angular) --> Save orders from users
  - [Cocktails](#laravel) --> Save cocktails
  - [CocktailsIngredients](#laravel) --> Table for the relationship between cocktails and ingredients

##Application use
Users created for MCO cocktail application(after migrate and seed in Laravel) ->
##### User 1

username -> mco
password -> mco

##### User 2

username -> mco2
password -> mco2






