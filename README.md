# Task Management Application

This is a simple Task Management application built using Laravel 11 and PHP > 8.2. The application provides an API for creating, reading, updating, and deleting tasks, as well as searching for tasks based on deadline and status.

## Installation and Setup
1. **Requirements**
   - PHP >= 8.2
   - Composer
   - Laravel 11.x
   - MySQL or any other supported database

2. **Installation and Setup**
   - Clone the repository:
     ```sh
     git clone https://github.com/SolomonPrince/task-manager.git
     cd task-management
     ```
   - Install dependencies:
     ```sh
     composer install
     ```
   - Create a copy of the `.env` file:
     ```sh
     cp .env.example .env
     ```
   - Generate the application key:
     ```sh
     php artisan key:generate
     ```
   - Configure your database in the `.env` file:
     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Run the database migrations:
     ```sh
     php artisan migrate
     ```
   - (Optional) Seed the database:
     ```sh
     php artisan db:seed
     ```
   - Start the development server:
     ```sh
     php artisan serve
     ```

3. **API Endpoints**
   - **Create a Task**
     - Endpoint: `POST /api/tasks`
     - Request Body:
       ```json
       {
         "title": "Task Title",
         "description": "Task Description",
         "status": "pending",
         "deadline": "2024-07-10T00:00:00Z"
       }
       ```
     - Response Example:
       ```json
       {
         "success": true,
         "data": {
           "id": 1,
           "title": "Task Title",
           "description": "Task Description",
           "status": "pending",
           "deadline": "2024-07-10T00:00:00Z",
           "created_at": "2024-07-06T00:00:00Z"
         }
       }
       ```
   - **Get All Tasks**
     - Endpoint: `GET /api/tasks`
     - Response Example:
       ```json
       {
         "success": true,
         "data": [
           {
             "id": 1,
             "title": "Task Title",
             "description": "Task Description",
             "status": "pending",
             "deadline": "2024-07-10T00:00:00Z",
             "created_at": "2024-07-06T00:00:00Z"
           },
           ...
         ]
       }
       ```
   - **Get a Single Task**
     - Endpoint: `GET /api/tasks/{id}`
     - Response Example:
       ```json
       {
         "success": true,
         "data": {
           "id": 1,
           "title": "Task Title",
           "description": "Task Description",
           "status": "pending",
           "deadline": "2024-07-10T00:00:00Z",
           "created_at": "2024-07-06T00:00:00Z"
         }
       }
       ```
   - **Update a Task**
     - Endpoint: `PUT /api/tasks/{id}`
     - Request Body:
       ```json
       {
         "title": "Updated Task Title",
         "description": "Updated Task Description",
         "status": "in_progress",
         "deadline": "2024-07-15T00:00:00Z"
       }
       ```
     - Response Example:
       ```json
       {
         "success": true,
         "data": {
           "id": 1,
           "title": "Updated Task Title",
           "description": "Updated Task Description",
           "status": "in_progress",
           "deadline": "2024-07-15T00:00:00Z",
           "created_at": "2024-07-06T00:00:00Z"
         }
       }
       ```
   - **Delete a Task**
     - Endpoint: `DELETE /api/tasks/{id}`
     - Response Example:
       ```json
       {
         "success": true,
         "data": null
       }
       ```
   - **Search Tasks**
     - Endpoint: `GET /api/tasks?status=pending&due_date=2024-07-10`
     - Response Example:
       ```json
       {
         "success": true,
         "data": [
           {
             "id": 1,
             "title": "Task Title",
             "description": "Task Description",
             "status": "pending",
             "deadline": "2024-07-10T00:00:00Z",
             "created_at": "2024-07-06T00:00:00Z"
           },
           ...
         ]
       }
       ```

4. **Code Overview**
   - **Models**
     - `Task`: Represents a task with attributes such as `title`, `description`, `status`, `deadline`, `created_at`, and `updated_at`.
   - **Controllers**
     - `TaskController`: Handles incoming API requests for managing tasks.
   - **Requests**
     - `TaskRequest`: Validates incoming requests for creating and updating tasks.
   - **Data**
     - `TaskData`: A data transfer object (DTO) used for transferring task data between layers of the application.
   - **Repositories**
     - `TaskRepository`: Implements the `TaskInterface` and provides methods for creating, updating, searching, and deleting tasks.
   - **Interfaces**
     - `TaskInterface`: Defines the methods that must be implemented by any task repository.
