<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Tag;
use App\Models\Comment;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Article::factory(20)
            ->has(Tag::factory())
            ->has(Comment::factory()->count(3))->create();
    }
}
