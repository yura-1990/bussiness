<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://projectlogourl.svg" width="400" alt="App logo"></a></p>

## About Project

# Requirements

1. PHP 8.1
2. Composer 2.2

# Installation

1. Clone the repository
2. Run `composer install`
3. Run `cp .env.example .env`
4. Run `php artisan key:generate`
5. Run `php artisan jwt:secret`
6. Run `php artisan migrate`
7. Run `php artisan serve`
8. Open [http://localhost:8000](http://localhost:800) in your browser
9. Swagger documentation is available at [http://localhost:8000/documentation](http://localhost:8000/documentation)

# Installation with docker

1. RUN `docker-compose build`
2. RUN `docker-compose up -d` for start
3. RUN `docker-compose down` for stop

# Deployment

1. Provide your server data in `.github/workflows/deployment.yml` and 
2. Push master branch to automatically deploy 

# Packages

1. [Laravel Passport](https://laravel.com/docs/passport)
2. [Laravel OpenAPI](https://vyuldashev.github.io/laravel-openapi/)
3. [Swagger UI](https://swagger.io/tools/swagger-ui/)
4. [JWT Auth](https://laravel-jwt-auth.readthedocs.io/en/latest/laravel-installation/)
5. [Route-attribute](https://github.com/spatie/laravel-route-attributes)

# OAuth

