<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel EAV API

This project demonstrates a RESTful API built with Laravel 10, featuring:

* User authentication with Laravel Passport
* Core models: User, Project, Timesheet with relationships
* EAV (Entity-Attribute-Value) implementation for dynamic project attributes
* Flexible filtering system for projects

## Setup Instructions

**Prerequisites**

* PHP 8.1 or higher
* Composer
* MySQL
* Git

**Installation**

1. Clone the repository:

```bash
git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
Install dependencies:
Bash

composer install
Configure the environment:
Copy .env.example to .env
Update the database credentials in .env
Set other environment variables as needed
Generate an application key:
Bash

php artisan key:generate
Run migrations:
Bash

php artisan migrate
Seed the database:
Bash

php artisan db:seed
API Documentation
Authentication

POST /api/register: Register a new user

Request body: {"first_name": "John", "last_name": "Doe", "email": "john.doe@example.com", "password": "password123"}
Response: 201 Created with user data and access token
POST /api/login: Login with existing user

Request body: {"email": "john.doe@example.com", "password": "password123"}
Response: 200 OK with user data and access token
POST /api/logout: Logout current user

Requires Authorization header with Bearer token
Response: 200 OK with success message
Projects

GET /api/projects: List all projects (supports filtering)

Example with filter: /api/projects?filters[name]=ProjectA&filters[department.eq]=IT
Response: 200 OK with an array of projects
GET /api/projects/{id}: Get a specific project by ID

Response: 200 OK with project details and EAV attributes
POST /api/projects: Create a new project

Request body:
JSON

{
    "name": "New Project",
    "status": "active",
    "attributes": [
        {"attribute_id": 1, "value": "Technology"},
        {"attribute_id": 2, "value": "2024-03-10"}
    ]
}
Response: 201 Created with the new project details
PUT /api/projects/{id}: Update a project

Request body (similar to create, with updated values)
Response: 200 OK with the updated project details
DELETE /api/projects/{id}: Delete a project

Response: 204 No Content
Timesheets

Similar CRUD endpoints as Projects, with relevant fields (user_id, project_id, task_name, date, hours)
Attributes

GET /api/attributes: List all attributes

Response: 200 OK with an array of attributes
GET /api/attributes/{id}: Get a specific attribute by ID

Response: 200 OK with attribute details
POST /api/attributes: Create a new attribute

Request body: {"name": "new_attribute", "type": "text"}
Response: 201 Created with the new attribute details
PUT /api/attributes/{id}: Update an attribute

Request body (similar to create, with updated values)
Response: 200 OK with the updated attribute details
DELETE /api/attributes/{id}: Delete an attribute

Response: 204 No Content
Example Requests/Responses
See the "API Documentation" section above for examples.
Test Credentials
Email: a.ahmed@example.com
Password: password1998
Note: You might need to create this test user manually or through the registration API.

Additional Information
This API follows RESTful principles and uses JSON for data exchange.
Error handling is implemented to provide informative error messages.
The filtering system supports basic operators (=, >, <, LIKE) for both regular and EAV attributes.
