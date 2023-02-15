<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $name =$faker->name;
        return [
            //
            "user_id"=>1,
            'name' => fake()->name(),
            'slug' => Str::slug(fake()->name()),
            'status' =>$this->faker->numberBetween(0,1),
        ];
    }
}
