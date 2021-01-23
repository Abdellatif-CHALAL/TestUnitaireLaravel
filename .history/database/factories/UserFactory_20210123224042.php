<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $faker->name,
            'last_name' => $faker->name,
            "date_naissance" => Carbon::now()->subYears(13)->toDateString(),
            'email' => $faker->unique()->safeEmail,
            'password' => 'password',

        ];
    }
}
