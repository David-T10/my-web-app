<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = new Comment;
        $c-> content="This is my post";
        $c->user_id =1;
        $c->post_id =1;
        $c->save();

        Comment::factory()->count(10)->create();
    }
}
