<?php

namespace AndrykVP\Rancor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AndrykVP\Rancor\Holocron\Models\Node;

class NodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Node::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'body' => $this->faker->paragraph(true),
            'is_public' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}