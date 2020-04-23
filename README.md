# Dorm Management App

## Purpose

RPA (Robotic Process Automation) for administration chores at a university boarding hall. This app will be deployed to the on-premise physical server (Perhaps Apache + CentOS) inside the dorm for 24/7.

- Manage accounting information for each boarder: Who paid? Who has arrear? How much shall I charge him in the next month? In my dorm, every boarder must pay boarding fees by Japan Post Bank accounts.
- Automatically assign housekeeping chores to every boarder
- Share documents: Meeting minutes, Financial report, etc.

## Installation

### Requirements

- Composer
- npm
- MySQL
    - Create database `laravel_dorm`
    - MySQL must run in the background; check status with `sudo systemctl status mysql` on linux, for example.
- config/database.php
    - `'default' => env('DB_CONNECTION', 'mysql'),` (Default value for Laravel)
- .env
    - `DB_CONNECTION=mysql` (Default value for Laravel)
    - `DB_DATABSE=laravel_dorm`

### Installation

Run these commands in the root directory of the Laravel application.

1. `composer install`
1. `npm install`
1. `copy .env.example .env`
1. `php artisan key:gen`
1. `php artisan migrate`
1. `php artisan db:seed`
1. `php artisan serve`

## Feature Dev Milestones

1. Laravel + Blade + MySQL
1. Accounting
    - Show payment history tables
    - Billing to each boarder: Monthly boarding fee, penalty fines, reward for dorm tasks
    - Register if the electronic payment was successful or not.
1. Show the latest info of the dorm
    - Notification to the members
    - Dorm events scheduling
    - Show "bad boarders" who didn't pay on schedule or those who didn't do the assigned dorm chores
1. Show the records on the events in the past
    - Minutes of the meeting
    - Monthly financial reports
    - History of the dorm events
1. Write w/ Vue.js instead of Blade
1. Login feature: Session Management, Middlewares
    - With E-mail & Password
1. Admin feature
1. Form Validation
1. Automatic Chores Scheduling
    - Ask every boarder which days are available for them
    - Confirm job scheduling
1. Data visualization feature (maybe Chart.js): Show the financial history of the dorm in the past
1. Vuetify

### Optional features
- Slack integration / LINE integration
- Google calendar integration
- Dockerize
- Deploy to the cloud server


## Dev History

1. `composer create-project --prefer-dist laravel/laravel my-app`
2. `cd my-app`
4. `composer require laravel/ui`
    - This updates composer.json
5. `php artisan ui vue --auth`
    - This updates package.json; e.g. adds `vue` to `devDependencies`
    - This adds some auth-related directories / files
    - This adds a sample Vue component, and alters `app.js`
6. `npm install`
7. 
