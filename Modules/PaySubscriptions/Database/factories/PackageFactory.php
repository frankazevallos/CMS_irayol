<?php

namespace Modules\PaySubscriptions\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\PaySubscriptions\Entities\Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 11),
            'name' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->text($maxNbChars = 500),
            'interval' => $this->faker->randomElement(['days', 'weeks', 'moths', 'years']),
            'interval_count' => 1,
            'trial_days' => $this->faker->numberBetween($min = 0, $max = 10),
            'price' => $this->faker->numberBetween($min = 10, $max = 25),
            'is_active' => 1
        ];
    }
}
