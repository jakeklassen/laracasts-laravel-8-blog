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

        $categories = Category::factory(3)->create();
        User::factory(5)
            ->has(
                Post::factory([
                    'category_id' => $categories->random()
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
