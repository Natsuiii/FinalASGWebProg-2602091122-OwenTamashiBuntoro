<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = ['Reading', 'Traveling', 'Cooking', 'Gaming', 'Hiking', 'Singing', 'Dancing', 'Painting', 'Writing', 'Photography', 'Sports'];

        foreach ($hobbies as $hobby) {
            Hobby::create(['name' => $hobby]);
        }
    }
}
