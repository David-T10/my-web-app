<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p = new Post;
        $p-> content="This is my post";
        $p->title="My first post";
        $p->user_id =1;
        $p->save();

        Post::factory()->count(10)->create();
    }
}
