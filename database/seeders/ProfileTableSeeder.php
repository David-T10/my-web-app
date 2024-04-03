<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hardcoded profiles for Admin and David
        $admin = User::where('name', 'Admin')->first();
        $david = User::where('name', 'David')->first();

        if ($admin && !$admin->profile) {
            $admin->profile()->create([
                'user_id' => $admin->id,
                'date_of_birth' => '2000-01-01',
                'bio' => 'I am the admin, lord of all',
                'profile_pic' => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.qobuz.com%2Fimages%2Fartists%2Fcovers%2Fmedium%2F16fd5acc0639d8fb9af87ee768d42e05.jpg&f=1&nofb=1&ipt=31130bf3f6b376221d4f8dbc8c9a32879bc2b2173485587fc17a4370ef14c195&ipo=images",
            ]);
        }

        if ($david && !$david->profile) {
            $david->profile()->create([
                'user_id' => $david->id,
                'date_of_birth' => '2001-10-18',
                'bio' => "David's bio, I like football",
                'profile_pic' => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.qobuz.com%2Fimages%2Fartists%2Fcovers%2Fmedium%2F16fd5acc0639d8fb9af87ee768d42e05.jpg&f=1&nofb=1&ipt=31130bf3f6b376221d4f8dbc8c9a32879bc2b2173485587fc17a4370ef14c195&ipo=images",
            ]);
        }

        // Generate random profiles for users without profiles
        User::doesntHave('profile')->get()->each(function ($user) {
            $user->profile()->create([
                'user_id' => $user->id,
                'date_of_birth' => fake()->date($format = 'Y-m-d', $max = 'now'),
                'bio' => fake()->realText($maxNbChars = 200),
                'profile_pic' => fake()->imageUrl($width = 200, $height = 200, 'people'),
            ]);
        });
    }
}
