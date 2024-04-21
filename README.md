## Prerequisites
1. PHP 8.1
2. Node 20.11.1
## Installation
1. RUN composer install
2. RUN npm install
3. Copy .env.example => .env
4. Update DB Connection DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
5. RUN php artisan key:generate
6. RUN php artisan migrate
7. RUN php artisan db:seed
8. RUN php artisan serve
