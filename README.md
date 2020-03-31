# Test build laravel with docker
## SET UP
1. docker-compose build
2. docker-compose up -d
3. docker-compose exec app cp .env.example .env
4. docker-compose exec app composer install
5. docker-compose exec app php artisan key:generate
6. docker-compose exec app php artisan migrate
7. docker-compose exec app php artisan db:seed
8. docker-compose exec app php artisan config:cache

## CONFIG
- Open file hosts and add "127.0.0.1 blog.local" into it.
