<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => '1',
            'brand' => fake()->name('5'),
            'name' => fake()->sentence('10'),
            'description' =>fake()->text('60'),
            'voltage' => rand(1,2) === 1 ? '110' : '220',
        ];
    }
}
