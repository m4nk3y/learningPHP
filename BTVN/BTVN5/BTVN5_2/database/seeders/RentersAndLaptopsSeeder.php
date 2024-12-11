<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RentersAndLaptopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $renterId = DB::table('renters')->insertGetId([
                'name' => $faker->name(),
                'phone_number' => $faker->phoneNumber(),
                'email' => $faker->email(),
            ]);

            $laptopCount = rand(1,5);
            for($j = 0; $j < $laptopCount; $j++){
                DB::table('laptops')->insert([
                    'brand' => $faker->company(),
                    'model' => $faker->sentence(1),
                    'specifications' => $faker->paragraph(2),
                    'rental_status' => $faker->boolean(),
                    'renter_id' => $renterId
                ]);
            }
        }
    }
}
