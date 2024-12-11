<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ITCentersAndHardwareDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){
            $itCentersId = DB::table('it_centers')->insertGetId([
                'name' => $faker->name(),
                'location' => $faker->address(),
                'contact_email' => $faker->email()
            ]);

            $hdCount = rand(1,5);
            for($j = 0; $j < $hdCount; $j++){
                DB::table('hardware_devices')->insert([
                    'device_name' => $faker->name(),
                    'type' => $faker->word(),
                    'status' => $faker->boolean(),
                    'center_id' => $itCentersId
                ]);
            }
        }
    }
}
