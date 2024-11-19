<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\Patients;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=1;$i<=1000;$i++){
            $patient = new Patients();
            $patient->name = $faker->name;
            $patient->patient_id = 2024090000+$i;
            $patient->contact_no = $faker->phoneNumber;
            $patient->address = $faker->address;
            $patient->age = $faker->numberBetween($min = 1, $max = 100);
            $patient->sex = $faker->randomElement(['M', 'F','O']);
            $patient->save();
        }

    }
}
