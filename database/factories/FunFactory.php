<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fun>
 */
class FunFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'link'=>"https://picsum.photos/id/237/200/300",
            'description'=>$this->faker->realText(),
            'type'=>$this->faker->randomElement(['public', 'private',"subscriber"]),
        ];
    }
}
