# Backend of the Subject Assignment System

This is the backend for the Subject Assignment System. Provides an API to manage student information.

## Used technology

- Laravel: The PHP framework used to build the backend.
- MySQL: Database used to store student information.

## Project Configuration

1. Clone this repository: `git clone https://github.com/and1kmpo/back-subject-assignment-system.git`
2. Install the dependencies: `composer install`
3. Configure the database in the `.env` file.
4. Run the migrations and seeder: `php artisan migrate --seed`

## Main Features

- API for the management of students, teachers, subjects, programs, careers and the relationship between these resources.

## Endpoints API
Student resources:
- `GET /api/students`: Gets the list of students.
- `GET /api/students/{id}`: Gets a specific student.
- `POST /api/students`: Add a new student.
- `PUT /api/students/{id}`: Updates a student's information.
- `DELETE /api/students/{id}`: Delete a student.

Teachers resource:
- `GET /api/professors`: Gets the teacher list.
- `GET /api/professors/{id}`: Gets a specific teacher.
- `POST /api/professors`: Add a new teacher.
- `PUT /api/professors/{id}`: Updates a teacher's information.
- `DELETE /api/professors/{id}`: Delete a teacher.

  Subject resources:
- `GET /api/subjects`: Gets the list of subjects.
- `GET /api/subjects/{id}`: Gets a specific subject.
- `POST /api/subjects`: Add a new subject.
- `PUT /api/subjects/{id}`: Updates the information of a subject.
- `DELETE /api/subjects/{id}`: Delete a subject.

  User resource:
- `GET /api/users`: Gets the list of users.
- `GET /api/users/{id}`: Gets a specific user.
- `POST /api/users`: Add a new user.
- `PUT /api/users/{id}`: Updates a user's information.
- `DELETE /api/users/{id}`: Delete a user.
