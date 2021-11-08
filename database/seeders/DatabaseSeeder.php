<?php

namespace Database\Seeders;

use App\Models\Category;
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

        $users = User::factory(5)->create();
        $categories = Category::factory(3)->create();

        foreach ($users as $user) {
            Post::factory(10)->create([
                'user_id' => $user,
                'category_id' => $categories->random()
            ]);
        }
    }
}
