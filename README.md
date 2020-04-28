# Dorm Management App

# ToC

- [Dorm Management App](#dorm-management-app)
- [ToC](#toc)
  - [Purpose](#purpose)
- [Installation](#installation)
  - [Requirements](#requirements)
  - [Installation](#installation-1)
- [Feature Milestones](#feature-milestones)
  - [Must have](#must-have)
  - [Optional Features](#optional-features)
- [Dev History](#dev-history)
  - [Start to connect Vue to Laravel](#start-to-connect-vue-to-laravel)
  - [Set up Postgres](#set-up-postgres)
  - [Test to seed to Postgres](#test-to-seed-to-postgres)
  - [Create Eloquent model](#create-eloquent-model)
  - [Add a column to existing table](#add-a-column-to-existing-table)
- [Troubleshooting](#troubleshooting)
  - [Error `could not find driver` on `php artisan migrate`](#error-could-not-find-driver-on-php-artisan-migrate)
  - [Error `password authentication failed for user "postgres"` on `php artisan migrate`](#error-password-authentication-failed-for-user-%22postgres%22-on-php-artisan-migrate)

## Purpose

RPA (Robotic Process Automation) for administration chores at a university boarding hall. This app will be deployed to the on-premise physical server (Perhaps Apache + CentOS) inside the dorm for 24/7.

- Manage accounting information for each boarder: Who paid? Who has arrear? How much shall I charge him in the next month? In my dorm, every boarder must pay boarding fees by Japan Post Bank accounts.
- Automatically assign housekeeping chores to every boarder
- Share documents: Meeting minutes, Financial report, etc.

# Installation

## Requirements

- Composer
- npm
- Postgres
  - Create database `dorm_db`
- config/database.php
  - `'default' => env('DB_CONNECTION', 'pgsql'),` (MySQL by default)
- .env
  - `DB_CONNECTION=pgsql` (MySQL by default)
  - `DB_DATABSE=laravel_dorm`
  - `APP_KEY` has the value. If not, generate with `php artisan key:generate`

## Installation

Run these commands in the root directory of the Laravel application.

1. `composer install`
1. `npm install`
1. `copy .env.example .env`
1. `php artisan key:gen`
1. `php artisan migrate`
1. `php artisan db:seed`
1. `php artisan serve`

# Feature Milestones

## Must have

- [x] Establish the data flow: Vue - Blade - Laravel - Eloquent - Postgres
- [ ] Accounting
  - Show payment history tables
  - Billing to each boarder: Monthly boarding fee, penalty fines, reward for dorm tasks
  - Register if the electronic payment was successful or not.
- [ ] Admin feature
- [ ] Form Validation
- [ ] Automatic Chores / Party Scheduling
  - Ask every boarder which dates are available for them
  - Confirm job scheduling
- [ ] Auth
  - Login
  - Session Management
  - Reset E-mail & Password
- [ ] Vuetify
- [ ] Visualize monthly billing amount with Chart.js
- [ ] Deploy on Heroku (or AWS)

## Optional Features

- [ ] Show the latest info of the dorm
  - Notification to the members
  - Dorm events scheduling
  - Show "bad boarders" who didn't pay on schedule or those who didn't do the assigned dorm chores
- [ ] Show the records on the events in the past
  - Minutes of the meeting
  - Monthly financial reports
  - History of the dorm events
- [ ] Slack integration / LINE integration
- [ ] Google calendar integration
- [ ] Dockerize

# Dev History

## Start to connect Vue to Laravel

1. `composer create-project --prefer-dist laravel/laravel my-app`
2. `cd my-app`
3. `composer require laravel/ui`
   - This updates composer.json
   - Necessary for folloing `artisan` command
4. `php artisan ui vue --auth`
   - This updates package.json; e.g. adds `vue` to `devDependencies`
   - This adds some auth-related directories / files
   - This adds `Home` controller which requires
   - This adds a sample Vue component, and alters `app.js`
5. `npm install`
6. Modify `welcome.blade.php`
   - `<meta name="csrf-token" content="{{ csrf_token() }}">` in head
   - `<example-component></example-component>` in body
   - `<script src="{{ mix('js/app.js') }}"></script>` in body
7. `npm run dev`
   - This generate CSS and JS in `/public`
   - You better use `npm run watch` for auto-comilation of .js / .css / .vue etc.
8. `php artisan serve`
   - Check if the Vue component is rendered correctly

## Set up Postgres

1. Install postgres
2. Edit `.env`
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=my_db
   DB_USERNAME=postgres
   DB_PASSWORD=mypw1234
   ```
3. `sudo su postgres`
4. `psql`
5. `CREATE DATABSE my_db`
6. `\l`
   - Ensure the created DB is listed here
7. `\q`
8. `exit`
9. `php artisan migrate` -> Refer to troubleshooting report below

## Test to seed to Postgres

1. `php artisan tinker`
1. `$user1 = new App\User`
1. `$user1->name = "john"`
1. `$user1->email = bcrypt("john1234)`
1. `$user1->save()`
1. `$user2 = new App\User`
1. `$user2->name = "sarah"`
1. `$user2->email = bcrypt("sarah1234)`
1. `$user2->save()`
1. Check if the 2 person are inserted in Postgres with `SELECT * from users`
   - Seemingly, objects from `App\User` are automatically linked to `users` table
1. Get these DB from Axios
   ```php
   use App\User
   Route::get('/users',function(){
      return User::all();
   });
   ```

## Create Eloquent model

1. `php artisan make:model Billing -m`
2. Add billing data with tinker

## Add a column to existing table

1. `php artisan make:migration add_user_id_to_billing`
   - Seemingly, the word "billing" is correctly recognized by Laravel as the target table name

# Troubleshooting

## Error `could not find driver` on `php artisan migrate`

1. `sudo apt install php-pgsql`

## Error `password authentication failed for user "postgres"` on `php artisan migrate`

1. Modify auth method: Open `pg_haba.conf`, then modify `local all all peer` row into `local all all md5`
1. `sudo su - psql`
1. `psql`
1. `ALTER USER postgres password 'mypw1234';`
