## Laravel PHPUnit Testing Project (In Progress)

This project was created to practice automated testing in Laravel using PHPUnit.
The focus of this project is to understand how to test controllers, routes, and authentication logic using Laravel’s built-in testing framework. It simulates a basic product management system with user authentication and a simple service for currency conversion.

### The goal of this project is to understand how to:

- Write unit and feature tests in Laravel
- Test database interactions, pagination, and controller logic
- Implement and test custom service classes
- The project is still in progress, with additional tests and functionalities being developed.

## Technologies Used

Laravel 9.19 – PHP framework
PHPUnit – for unit and feature testing
PHP 8.0.2
Composer – dependency manager
Blade – templating engine
MySQL – database
Bootstrap

## Features (current progress)

- User authentication (login, registration, and profile management)
- Product management (CRUD operations for products)
- CurrencyService for currency conversion logic
- Pagination implemented with Eloquent
- Dashboard displaying product list
- Feature tests for ProductController
- Unit tests for CurrencyService
- Middleware protection for authenticated routes

## Setup Instructions

Clone the repository: git clone https://github.com/yourusername/laravel-phpunit-practice.git
cd laravel-phpunit-practice

Install dependencies:   cp .env.example .env
                        php artisan key:generate

Start the development server: php artisan serve

App will be available at: http://localhost:8000

## What I’m Learning

Writing unit tests for controllers and models
Writing feature tests for authentication and CRUD routes
Testing with an MySQ database
Structuring tests with PHPUnit best practices

## Project Status

- In Progress
