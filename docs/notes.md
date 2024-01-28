Below are the steps followed to complete the Part 1 & Part 2 Tasks 

Installed PHP Version 8.1.25
Modified composer.josn to match "php": "^8.1"
composer update 
cp .env.example .env
php artisan key:generate
sudo n 21
npm install && npm run dev
I have used mysql databasse instead of sqlite
php artisan migrate:fresh --seed
php artisan serve

#created sales table to record the sales
php artisan make:migration create_sales_table
php artisan migrate

#I have implemented frontend calculations for the selling price. While backend calculations can be incorporated for additional robustness in the future.

I will start part 2 after committing part 1.

https://github.com/nagendran-lbit/laravel-test-part1.git

php artisan make:migration add_product_column_to_sales_table --table=sales
php artisan migrate

https://github.com/nagendran-lbit/laravel-test-part2.git