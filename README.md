# SubjectAssignmentSystem

# Backend del Sistema de Asignación de Materias

Este es el backend para el Sistema de Asignación de Materias. Proporciona una API para gestionar la información de los estudiantes.

## Tecnologías Utilizadas

- Laravel: El framework de PHP utilizado para construir el backend.
- MySQL: Base de datos utilizada para almacenar la información de los estudiantes.

## Configuración del Proyecto

1. Clona este repositorio: `git clone https://github.com/and1kmpo/back-subject-assignment-system.git`
2. Instala las dependencias: `composer install`
3. Configura la base de datos en el archivo `.env`.
4. Ejecuta las migraciones y seeder: `php artisan migrate --seed`

## Funcionalidades Principales

- API para la gestión de estudiantes, profesores, asignatura, programas, carreras y relación entre estos recursos.

## Endpoints API
Recurso estudiantes:
- `GET /api/students`: Obtiene la lista de estudiantes.
- `GET /api/students/{id}`: Obtiene un estudiante específico.
- `POST /api/students`: Agrega un nuevo estudiante.
- `PUT /api/students/{id}`: Actualiza la información de un estudiante.
- `DELETE /api/students/{id}`: Elimina un estudiante.

Recurso profesores:
- `GET /api/professors`: Obtiene la lista de profesor.
- `GET /api/professors/{id}`: Obtiene un profesor en específico.
- `POST /api/professors`: Agrega un nuevo profesor.
- `PUT /api/professors/{id}`: Actualiza la información de un profesor.
- `DELETE /api/professors/{id}`: Elimina un profesor.

  Recurso asignaturas:
- `GET /api/subjects`: Obtiene la lista de asignaturas.
- `GET /api/subjects/{id}`: Obtiene una asignatura en específico.
- `POST /api/subjects`: Agrega una nueva asignaturas.
- `PUT /api/subjects/{id}`: Actualiza la información de una asignaturas.
- `DELETE /api/subjects/{id}`: Elimina una asignaturas.

  Recurso usuarios:
- `GET /api/users`: Obtiene la lista de usuarios.
- `GET /api/users/{id}`: Obtiene un usuario en específico.
- `POST /api/users`: Agrega un nuev usuario.
- `PUT /api/users/{id}`: Actualiza la información de un usuario.
- `DELETE /api/users/{id}`: Elimina un usuario.



