<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibrariesAndBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $libraryId = DB::table('libraries')->insertGetId([
                'name' => $faker->company . " Library",
                'address' => $faker->address,
                'contact_number' => $faker->phoneNumber,
            ]);

            // Tạo dữ liệu cho bảng books, mỗi thư viện có 5-15 sách
            $bookCount = rand(5, 15);
            for ($j = 0; $j < $bookCount; $j++) {
                DB::table('books')->insert([
                    'title' => $faker->sentence(rand(2, 5)),
                    'author' => $faker->name,
                    'publication_year' => $faker->year,
                    'genre' => $faker->word,
                    'library_id' => $libraryId,
                ]);
            }
        }
    }
}
