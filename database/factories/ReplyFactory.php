<?php

namespace AndrykVP\Rancor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AndrykVP\Rancor\Forum\Models\Reply;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(true),
        ];
    }
}