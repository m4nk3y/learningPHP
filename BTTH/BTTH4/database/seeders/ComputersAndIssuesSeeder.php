<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersAndIssuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $computerId = DB::table('computers') -> insertGetId([
                'computer_name' => $faker->name(),
                'model' => $faker->word(),
                'operating_system' => $faker->word(),
                'processor' => $faker->word(),
                'memory' => $faker->numberBetween(1024, 8192),
                'available' => $faker->boolean()
            ]);

            $issuesCount = 5;
            for($j = 0; $j < $issuesCount; $j++){
                DB::table('issues')->insert([
                    'reported_by' => $faker->name(),
                    'reported_date' => $faker->dateTime(),
                    'description' => $faker->paragraph(3),
                    'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                    'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                    'computer_id' => $computerId
                ]);
            }
        }
    }
}
