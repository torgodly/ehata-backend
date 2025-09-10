<?php

namespace Database\Factories;

use App\Enum\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(4, true),
            'status' => PostStatus::Published,
            'featured_at' => $this->faker->optional(0.3)->dateTimeBetween('-1 month', 'now'),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the post is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::Draft,
        ]);
    }

    /**
     * Indicate that the post is archived.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatus::Archived,
        ]);
    }

    /**
     * Indicate that the post is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured_at' => now(),
        ]);
    }

    /**
     * Configure the model factory.
     */
    public function configure()
    {
        return $this->afterCreating(function ($post) {
            // Add sample images using Spatie Media Library
            $this->addSampleImages($post);
        });
    }

    /**
     * Add sample images to the post.
     */
    protected function addSampleImages($post)
    {
        // Sample image URLs for policy/blog related images
        $sampleImages = [
            'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop',
        ];

        // Randomly select 1-4 images for each post
        $imageCount = $this->faker->numberBetween(1, 4);
        $selectedImages = $this->faker->randomElements($sampleImages, $imageCount);

        foreach ($selectedImages as $imageUrl) {
            try {
                // Download and add the image to the post
                $post->addMediaFromUrl($imageUrl)
                    ->toMediaCollection('images');
            } catch (\Exception $e) {
                // If image download fails, create a placeholder
                $this->createPlaceholderImage($post);
            }
        }
    }

    /**
     * Create a placeholder image if external image fails.
     */
    protected function createPlaceholderImage($post)
    {
        // Create a simple colored rectangle as placeholder
        $width = 800;
        $height = 600;

        $image = imagecreate($width, $height);

        // Generate a random pastel color
        $r = $this->faker->numberBetween(180, 220);
        $g = $this->faker->numberBetween(180, 220);
        $b = $this->faker->numberBetween(180, 220);

        $backgroundColor = imagecolorallocate($image, $r, $g, $b);
        $textColor = imagecolorallocate($image, 100, 100, 100);

        // Fill background
        imagefill($image, 0, 0, $backgroundColor);

        // Add text
        $text = 'Policy Post';
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);

        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        imagestring($image, $fontSize, $x, $y, $text, $textColor);

        // Save to temporary file
        $tempPath = tempnam(sys_get_temp_dir(), 'post_');
        imagepng($image, $tempPath);
        imagedestroy($image);

        // Add to media collection
        $post->addMedia($tempPath)
            ->toMediaCollection('images');

        // Clean up temp file
        unlink($tempPath);
    }
}
