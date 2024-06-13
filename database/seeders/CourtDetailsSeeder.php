<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourtDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $locations = ['Selangor', 'Kelantan', 'Terengganu', 'Perak', 'Kedah', 'Johor', 'Kuala Lumpur', 'Perlis', 'N. Sembilan', 'Melaka', 'Pahang'];
        $locationCount = count($locations);

        // Generate fake data for court_details table
        for ($i = 1; $i <= 11; $i++) { // Adjust the number of records as needed
            $locationIndex = ($i - 1) % $locationCount; // Calculate the index of the location element
            DB::table('court_details')->insert([
                'name' => $faker->words(3, true),
                'location' => $locations[$locationIndex], // Use the element at the calculated index
                'status' => 'available',
                'type' => $faker->randomElement(['Indoor', 'Outdoor']),
                'contact' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}