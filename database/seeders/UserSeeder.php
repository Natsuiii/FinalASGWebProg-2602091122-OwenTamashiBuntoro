<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['male', 'female']),
                'instagram' => $faker->userName,
                'password' => bcrypt('password'),
            ]);

            $hobbies = Hobby::inRandomOrder()->take(3)->pluck('id');
            $user->hobbies()->attach($hobbies);
        }

    }
}
