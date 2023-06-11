<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Post::truncate();
        Category::truncate();
        User::truncate();

        $user1 = User::factory()->create([
            'name' => 'Meiza Acrisius',
            'username' => 'meizaacr'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Avilio',
            'username' => '4v1l1o'
        ]);

        $category1 = Category::factory()->create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        $category2 = Category::factory()->create([
            'name' => 'Hobbies',
            'slug' => 'hobbies',
        ]);

        $category3 = Category::factory()->create([
            'name' => 'Work',
            'slug' => 'work',
        ]);

        Post::factory(5)->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
        ]);
        Post::factory(5)->create([
            'user_id' => $user1->id,
            'category_id' => $category2->id,
        ]);

        Post::factory(5)->create([
            'user_id' => $user2->id,
            'category_id' => $category1->id,
        ]);

        Post::factory(5)->create([
            'user_id' => $user2->id,
            'category_id' => $category2->id,
        ]);
        Post::factory(2)->create([
            'user_id' => $user1->id,
            'category_id' => $category3->id,
        ]);
        Post::factory(3)->create([
            'user_id' => $user2->id,
            'category_id' => $category3->id,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
