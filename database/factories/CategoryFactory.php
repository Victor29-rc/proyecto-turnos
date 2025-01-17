<?php

namespace Database\Factories;

use App\Models\Category;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $priority = 1;

        return [
            'name' => $this->faker->unique()->Word(10),
            'priority' => random_int(1, 5)
        ];
    }
}
