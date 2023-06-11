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

        $category1 = Category::factory()->create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(5)->create([
            'user_id' => $user1->id,
            'category_id' => $category1->id,
        ]);

        Post::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
