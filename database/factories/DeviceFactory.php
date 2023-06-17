<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    public $brands = array('Eletrolux', 'Brastemp', 'Fischer', 'Samsung', 'LG');

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->randomElement($this->brands),
            'name' => fake()->name(),
            'description' =>fake()->text(60),
            'voltage' => rand(1,2) === 1 ? '110' : '220',
        ];
    }
}
