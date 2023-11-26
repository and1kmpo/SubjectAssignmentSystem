<?php
// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Subject;
use App\Models\Program;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear programas
        $programs = Program::factory(3)->create();

        // Crear estudiantes y asignar programas
        $students = Student::factory(10)->create(['program_id' => $programs->random()]);

        // Crear profesores
        $professors = Professor::factory(5)->create();

        // Crear asignaturas
        $subjects = Subject::factory(20)->create();

        // Asignar aleatoriamente asignaturas a estudiantes y profesores
        $students->each(function ($student) use ($subjects, $professors) {
            if ($professors->count() > 0) {
                $subject = $subjects->random();
                $professor = $professors->random();

                $student->subjects()->attach($subject, ['professor_id' => $professor->id]);
                $professor->subjects()->attach($subject);
            }
        });
    }
}
