# Dorm Management App

## Purpose

Going to use this app for RPA (Robotic Process Automation) at an university boarding hall

- Manage accounting information for each boarder: Who paid? Who has arrear? How much shall I charge him in the next month?
- Automatically assign housekeeping chores to every boarder
- Share documents: Meeting report, Financial report, etc.

## Installation

### Requirements

- Composer
- npm
- MySQL
  - Create database `laravel_dorm`
- .env
  - DB_DATABSE=laravel_dorm

### Installation

1. `composer install`
1. `npm install`
1. `php artisan key:gen`
1. Seeding
1. `php artisan serve`

## Feature Dev Milestones

1. Laravel + Blade + MySQL
1. Accounting
  - Show payment history tables
  - Billing to each boarder: Monthly boarding fee, penalty fines, reward for dorm tasks
  - Register if the electronic payment was successful or not
1. Write w/ Vue.js instead of Blade
1. Login feature: Session Management, Middlewares
  - With E-mail & Password
1. Admin feature
1. Form Validation
1. Automatic Chores Scheduling
  - Ask every boarder which days are available for them
  - Confirm job scheduling
1. Data visualization feature (maybe Chart.js)
1. Vuetify

### Optional features
- Slack Integration
- Google Calendar Integration
- Dockerize
- Deploy to the cloud server rather than on-premise one