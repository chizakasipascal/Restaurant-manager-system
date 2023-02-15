<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $title = $faker->sentence;
        return [
            //
           "user_id"=>1,
           "title" =>fake()->sentence(),
           "slug"=> Str::slug(fake()->sentence()),
           "description"=>$this->faker->paragraph,
           "image" =>"https://picsum.photos/600/400",
           "category_id"=>$this->faker->unique()->numberBetween(1,10),
           "price" => $this->faker->numberBetween($min = 100, $max = 500),
        ];
    }
}
