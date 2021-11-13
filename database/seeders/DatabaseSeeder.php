<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $thumbnails = collect([
            'thumbnails/illustration-1.png',
            'thumbnails/illustration-2.png',
            'thumbnails/illustration-3.png',
            'thumbnails/illustration-4.png',
            'thumbnails/illustration-5.png',
        ]);

        $categories = Category::factory(3)->create();
        User::factory(5)
            ->has(
                Post::factory([
                    // These are repeating! How to fix? Closure?
                    'category_id' => $categories->random(),
                    'thumbnail' => $thumbnails->random(),
                ])
                    ->has(Comment::factory()->count(10))->count(10)
            )
            ->create();

        // foreach ($users as $user) {
        //     Post::factory(10)->has(Comment::factory()->count(4))->create([
        //         'user_id' => $user,
        //         'category_id' => $categories->random()
        //     ]);
        // }
    }
}
