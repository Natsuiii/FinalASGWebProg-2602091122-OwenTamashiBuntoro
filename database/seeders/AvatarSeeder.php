<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 20; $i++)
        {
            Avatar::create([
                'name' => $faker->sentence(3),
                'path' => 'avatars/avatar-' . $i . '.jpeg',
                'price' => $faker->randomElement([50, 300, 500, 1000, 5000, 10000, 50000, 100000]),
            ]);
        }
    }
}
