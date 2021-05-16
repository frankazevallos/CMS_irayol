<?php
namespace Modules\Courses\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Courses\Entities\Section;

class ClasseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Courses\Entities\Classe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'section_id' => Section::all()->random()->id,
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'note' => $this->faker->text($maxNbChars = 500),
            'media_type' => 'video',
            'url' => 'https://player.vimeo.com/video/211331069',
            'duration' => $this->faker->time($format = 'H:i', $max = 'now'),
            'is_active' => 1,
        ];
    }
}