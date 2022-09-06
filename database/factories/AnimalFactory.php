<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name  = fake()->name();
        $gender = fake()->randomElement(['Male', 'Female']);
        $type = fake()->randomElement(['Dog', 'Cat']);
        $breed = fake()->text(10);
        $age = fake()->randomDigit();
        return compact('name','gender', 'type', 'breed', 'age'); 
    }
}
