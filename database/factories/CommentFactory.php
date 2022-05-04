<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'body' => $this->faker->text,
            'subject' => $this->faker->realText($maxNbChars = 10),
        ];
    }
}
