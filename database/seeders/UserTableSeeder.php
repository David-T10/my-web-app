<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u = new User;
        $u->name ="David";
        $u->email = "dave@gmail.com";
        $u->password = bcrypt("password");
        $u->date_of_birth="18/10/2001";
        $u->bio ="David's bio, I like football";
        $u->profile_pic="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.qobuz.com%2Fimages%2Fartists%2Fcovers%2Fmedium%2F16fd5acc0639d8fb9af87ee768d42e05.jpg&f=1&nofb=1&ipt=31130bf3f6b376221d4f8dbc8c9a32879bc2b2173485587fc17a4370ef14c195&ipo=images";
        $u -> save();

        $admin = new User;
        $admin -> name = "Admin";
        $admin -> email = "admin@gmail.com";
        $admin -> password = bcrypt("admin123");
        $admin ->date_of_birth="01/01/2000";
        $admin -> bio = "I am the admin, lord of all";
        $admin->profile_pic="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.qobuz.com%2Fimages%2Fartists%2Fcovers%2Fmedium%2F16fd5acc0639d8fb9af87ee768d42e05.jpg&f=1&nofb=1&ipt=31130bf3f6b376221d4f8dbc8c9a32879bc2b2173485587fc17a4370ef14c195&ipo=images";
        $admin -> save();

        $user = User::factory()->count(5)->has(Post::factory()->count(3)->has(Comment::factory()->count(5)))->create();

        //User::factory()->count(10)->create();
    }
}
