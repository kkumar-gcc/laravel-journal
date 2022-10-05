<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title=$this->faker->text(30);
        return [
            'title'=>$title,
            'body'=>$this->faker->realText(),
            'status'=>$this->faker->randomElement(['posted', 'drafted']),
            'slug'=> SlugService::createSlug(Blog::class, 'slug', $title),
        ];
    }
}
