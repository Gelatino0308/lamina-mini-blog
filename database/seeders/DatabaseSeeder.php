<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Post::factory(4)->create(); 
        Post::all()->each(function ($post) {
            Comment::factory(3)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id
            ]);
        });
    }
}
