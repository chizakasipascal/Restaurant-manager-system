<?php

namespace Database\Factories;

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
        $title = $faker->sentence;
        return [
            //
           "title" => $title,
           "slug"=> Str:: slug($title),
           "description" => $faker->paragraph,
           "image" =>"https://picsum.photos/600/400",
           "category_id" => factory(Category::class),
           "price" =>$faker->numberBetween($min = 100, $max = 500)


        ];
    }
}
