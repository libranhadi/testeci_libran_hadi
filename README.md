# testeci_libran_hadi


Brief description or introduction of the project.

Setup Environment
Make sure you have the following environment variables set in your .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_database_password


Installation 
1. Clone Repository
git clone https://github.com/libranhadi/testeci_libran_hadi


2. Install Composer Dependencies
composer install

3. Generate autoload files
composer dump-autoload

4. Generate Laravel Session Table
php artisan session:table

5. Run Database Migrations
php artisan migrate


RUN 
php artisan serve


