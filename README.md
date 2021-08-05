# ASSESSMENT
- This Assessment is about INEC based on dummy data

## LARAVEL INSTALLATION PROCESS

- Install Composer Dependencies " composer install "
- Create a copy of your .env file  " cp .env.example .env "
- Generate an app encryption key  "php artisan key:generate"
- Import Your Database (the Database is the same database i downloaded to work with)
- In the .env file, add database information to allow Laravel to connect to the database
- Run Laravel Server using "php artisan serve" or " php -S localhost:8100 -t public/ " so that it can run on port 8000 or 8100