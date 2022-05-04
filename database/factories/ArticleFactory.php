<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Article::class;

    public function definition()
    {
        return [
            'body' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'cover' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
