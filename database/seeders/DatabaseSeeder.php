<?php

namespace Database\Seeders;

use App\Enum\PostStatus;
use App\Models\Consultation;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);

        // Create some sample tags
        $tags = [
            'Digital Privacy',
            'Cyber Security',
            'Data Protection',
            'Internet Freedom',
            'Digital Rights',
            'Technology Policy',
            'Online Safety',
            'Digital Inclusion',
            'Policy Analysis',
            'Research',
            'Digital Governance',
            'AI Ethics'
        ];

        $tagModels = [];
        foreach ($tags as $tagName) {
            $tagModels[] = Tag::findOrCreate($tagName, 'tags');
        }

        // Create some sample categories
        $categories = [
            'Technology',
            'Privacy',
            'Security',
            'Rights',
            'Policy',
            'Digital',
            'Research',
            'Analysis'
        ];

        $categoryModels = [];
        foreach ($categories as $categoryName) {
            $categoryModels[] = Tag::findOrCreate($categoryName, 'categories');
        }

        $posts = Post::factory(15)->create([
            'status' => PostStatus::Published,
        ]);
// Add tags and categories to consultations
        foreach ($posts as $post) {
            // Add 2-4 random tags
            $randomTags = collect($tagModels)->random(rand(2, 4));
            $post->syncTags($randomTags, 'tags');

            // Add 1-2 random categories
            $randomCategories = collect($categoryModels)->random(rand(1, 2));
            $post->syncTags($randomCategories, 'categories');
        }

    }
}
