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
        $a = new Comment;
        $a-> content="This is my post";
        $a->user_id =1;
        $a->save();

        Comment::factory()->count(10)->create();
    }
}
