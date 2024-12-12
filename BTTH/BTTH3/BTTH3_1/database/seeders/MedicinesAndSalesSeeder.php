<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MedicinesAndSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    function generateFixedLinePhone() {
        return '08' . rand(10000000, 99999999);
    }

    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $medicineId = DB::table('medicines')->insertGetId([
                'name' => $faker->name(),
                'brand' => $faker->name() . "Pharma",
                'dosage' => $faker->word(),
                'form' => $faker->word(),
                'price' => $faker->numberBetween(100, 2000),
                'stock' => $faker->numberBetween(50, 200)
            ]);

            $salesCount = rand(2,6);
            for($j = 0; $j < $salesCount; $j++){
                DB::table('sales')->insert([
                    'quantity' => $faker->numberBetween(10, 100),
                    'sale_date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'customer_phone' => $this->generateFixedLinePhone(),
                    'medicine_id' => $medicineId
                ]);
            }
        }
    }
}
