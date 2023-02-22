<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\Position;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $val = true;
        $head = [];

        while($val) {
            $head = Employee::inRandomOrder()->first();
            $val = $head->headsCount() <= 4 ? false: true;
        }

        return [
            'name'=> $this->faker->name(),
            'position_id' =>  Position::inRandomOrder()->first()->id,
            'employment_date' => $this->faker->dateTimeThisDecade($max='now'),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'photo' => 'img/employees/main/1677044738_default.jpg',
            'salary' => $this->faker->numberBetween($min = 0, $max = 500),
            'preview_photo' => 'img/employees/preview/1677044738_default.jpg',
            'admin_created_id' => '1',
            'admin_updated_id' => '1',
            'head_id' => $head->id,
        ];
    }
}
