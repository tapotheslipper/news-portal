<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\ArticleFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\TagFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $userFactory = UserFactory::new();
        $user1 = $userFactory->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $user2 = $userFactory->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $categories = CategoryFactory::new()->count(5)->create();
        $tags = TagFactory::new()->count(10)->create();

        ArticleFactory::new()->count(30)->create([
            'user_id' => $user1->id,
            'category_id' => function () use ($categories) {
                return $categories->random()->id;
            },
        ])->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray(),
            );
        });
    }
}
