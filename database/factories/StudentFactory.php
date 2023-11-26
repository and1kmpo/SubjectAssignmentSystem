<?php

// database/factories/StudentFactory.php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $program = Program::factory()->create();

        return [
            'document' => $this->faker->unique()->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'picture' => $this->faker->imageUrl,
            'semester' => $this->faker->numberBetween(1, 10),
            'program_id' => $program->id,
        ];
    }
}
