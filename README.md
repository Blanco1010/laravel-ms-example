<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to Install Laravel

To install Laravel, ensure that PHP and Composer are installed on your system.

### Prerequisites

- PHP >= 8.0
- Composer
- Required PHP extensions (see the [official documentation](https://laravel.com/docs/installation) for details)

### Installation Steps

1. **Install Composer** (if not already installed):
   - Download and install Composer from [https://getcomposer.org/](https://getcomposer.org/).

2. **Install Laravel via Composer:**
   ```sh
   composer global require laravel/installer
   ```

3. **Clone the Laravel project from GitHub:**
   ```sh
   git clone https://github.com/Blanco1010/laravel-ms-example.git
   ```

4. **Install project dependencies:**
   ```sh
   composer install
   ```

5. **Set up environment variables:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
6. **Configure database connection in the .env file.**

## Running Laravel

To start the Laravel development server, run:
```sh
php artisan serve
```
This will start the server at `http://127.0.0.1:8000` by default.

## Database Migrations and Seeding

To create database tables and seed them with initial data:

1. **Run migrations:**
   ```sh
   php artisan migrate
   ```

2. **Run seeders:**
   ```sh
   php artisan db:seed
   ```
   To run a specific seeder:
   ```sh
   php artisan db:seed --class=UserSeeder
   ```

3. **Reset and re-run migrations with seeders:**
   ```sh
   php artisan migrate:refresh --seed
   ```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
