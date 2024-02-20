<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t= new Tag;
        $t->tagName = "happy";
        $t->save();
        $t->posts()->attach(1); //attaches this tag to the user indexed
        $t->posts()->attach(3);

    }
}
