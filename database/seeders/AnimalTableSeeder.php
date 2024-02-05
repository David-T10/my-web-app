<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = new Animal;
        $a->name ="Leroy";
        $a->weight="10.0";
        $a->save();

        Animal::factory()->count(50)->create();

    }
}
