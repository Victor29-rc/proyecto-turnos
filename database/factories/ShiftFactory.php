<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;



class ShiftFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shift::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ticket_code' => $this->faker->unique()->word(8),
            'date_time' => Carbon::now(),
            'category_id' => Category::all()->random()->id,
            'user_id' => null
        ];
    }
}
