<?php

namespace Database\Factories;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'content' => $this->faker->text(),
            "created_at" => Carbon::now(),

        ];
    }
}
