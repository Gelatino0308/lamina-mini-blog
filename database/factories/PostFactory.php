<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $animeTitles = [
            'Attack on Titan Season 4: The Final Chapter Review',
            'Demon Slayer Entertainment District Arc Analysis',
            'One Piece Wano Arc: Epic Conclusion Thoughts',
            'My Hero Academia Season 6 Character Development',
            'Jujutsu Kaisen 0 Movie: A Masterpiece Analysis',
        ];
    
        $mangaTitles = [
            'Berserk Chapter 374: Miura\'s Legacy Continues',
            'One Piece Chapter 1100: Revolutionary Revelations',
            'Chainsaw Man Part 2: Asa and Yoru Dynamic',
            'Jujutsu Kaisen Culling Game Arc Deep Dive',
            'My Hero Academia Final Arc Predictions',
        ];
    
        $animeArticleBodies = [
            'The animation quality in this latest season has been absolutely phenomenal. Every fight scene is choreographed to perfection, and the emotional moments hit harder than ever. The voice acting brings each character to life in ways that surpass even my highest expectations. This series continues to set the standard for what anime can achieve.',
            'Character development has always been the strongest aspect of this series, and this arc proves it once again. We see our protagonists face their deepest fears and overcome seemingly impossible obstacles. The way the story weaves together multiple character arcs while maintaining perfect pacing is truly remarkable.',
            'The world-building in this anime is second to none. Every detail feels carefully crafted and purposeful. The political intrigue, combined with spectacular action sequences, creates a viewing experience that keeps you on the edge of your seat. This is storytelling at its finest.',
            'What strikes me most about this series is its ability to balance humor with serious themes. The comedic moments provide perfect relief from the intense dramatic scenes, creating a well-rounded viewing experience. The character interactions feel genuine and develop naturally throughout the story.',
            'The soundtrack deserves special recognition for elevating every scene to new heights. Each musical piece perfectly complements the on-screen action and emotion. Combined with stunning visuals and exceptional voice work, this creates an audiovisual masterpiece that will be remembered for years.',
        ];
    
        $mangaArticleBodies = [
            'The artwork in this latest chapter showcases the mangaka\'s incredible skill development. Every panel tells a story, with detailed backgrounds that enhance the narrative rather than distract from it. The character expressions convey emotion with remarkable subtlety and power.',
            'This story arc represents a masterclass in manga storytelling. The pacing builds tension gradually while revealing character motivations in surprising ways. Each chapter leaves you desperately wanting more, which is the mark of truly exceptional manga.',
            'The way this manga handles its themes of friendship and sacrifice is both heartbreaking and inspiring. The author doesn\'t shy away from difficult topics, presenting them with honesty and emotional depth. This is manga that stays with you long after reading.',
            'Plot twists in manga can often feel forced, but this series handles them with incredible finesse. Each revelation feels both surprising and inevitable, showing masterful planning from the author. The foreshadowing becomes clear only in hindsight, making rereads incredibly rewarding.',
            'The character designs in this manga are instantly recognizable and memorable. Each character has a distinct visual identity that reflects their personality perfectly. The author\'s ability to convey character through art alone is truly impressive.',
        ];
    
        return [
            'user_id' => 1,
            'title' => fake()->randomElement(array_merge($animeTitles, $mangaTitles)),
            'category' => fake()->randomElement(array_keys(Post::getCategories())),
            'body' => fake()->randomElement(array_merge($animeArticleBodies, $mangaArticleBodies)),
            'image' => 'posts_images/default.jpg',
            'likes' => fake()->numberBetween(0, 50)
        ];
    }
}
