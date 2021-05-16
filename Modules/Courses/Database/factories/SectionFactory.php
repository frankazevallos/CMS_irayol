<?php
namespace Modules\Courses\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Courses\Entities\Course;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Courses\Entities\Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course_id' => Course::all()->random()->id,
            'title' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        ];
    }
}

