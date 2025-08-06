<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $animeComments = [
            'This anime is absolutely amazing! The character development is top-notch.',
            'I love the animation quality in this series.',
            'The plot twist in the latest episode blew my mind!',
            'This is one of my favorite anime of all time.',
            'The soundtrack is incredible, really adds to the emotional scenes.',
            'Can\'t wait for the next season!',
            'The voice acting is phenomenal in both sub and dub.',
            'This series deserves more recognition.',
            'The fight scenes are choreographed perfectly.',
            'Really enjoyed this review, thanks for sharing!'
        ];

        return [
            'user_id' => 1,
            'post_id' => Post::all()->random()->id,
            'comment' => fake()->randomElement($animeComments)
        ];
    }
}
