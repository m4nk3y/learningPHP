<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CinemasAndMoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $cinemasId = DB::table('cinemas') -> insertGetId([
                'name' => $faker->name() . "Cinema",
                'location' => $faker->address(),
                'total_seats' => $faker->numberBetween(50, 300)
            ]);

            $moviesCount = rand(1,5);
            for($j = 0; $j < $moviesCount; $j++){
                DB::table('movies')->insert([
                    'title' => $faker->sentence(4),
                    'director' => $faker->name(),
                    'release_date' => $faker->date('Y-m-d'),
                    'duration' => $faker->numberBetween(40, 120),
                    'cinema_id' => $cinemasId
                ]);
            }
        }
    }
}
