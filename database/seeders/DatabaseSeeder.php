<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Position::factory(30)->create([
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        /*Employee::create([
            'name'=> $faker->name(),
            'position_id' =>  Position::inRandomOrder()->first()->id,
            'employment_date' => $faker->dateTimeThisDecade($max='now'),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->unique()->safeEmail(),
            'photo' => 'img/employees/main/1677044738_default.jpg',
            'salary' => $faker->numberBetween($min = 0, $max = 500),
            'preview_photo' => 'img/employees/preview/1677044738_default.jpg',
            'admin_created_id' => '1',
            'admin_updated_id' => '1',
            'head_id' => null,
        ]);*/

        for ($i=0; $i < 10000; $i++) {
            Employee::factory(5)->create();
        }
    }
}
