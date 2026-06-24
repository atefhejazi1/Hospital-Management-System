<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = Section::all();
        $arFaker = fake('ar_SA');

        foreach ($sections as $section) {
            for ($i = 0; $i < 5; $i++) {
                $doctor = new Doctor();
                $doctor->email = fake()->unique()->safeEmail();
                $doctor->email_verified_at = now();
                $doctor->password = 'password';
                $doctor->phone = fake()->numerify('05########');
                $doctor->status = fake()->boolean(85) ? 1 : 0;
                $doctor->section_id = $section->id;
                $doctor->save();

                $doctor->translateOrNew('en')->name = 'Dr. ' . fake()->firstName() . ' ' . fake()->lastName();
                $doctor->translateOrNew('ar')->name = 'د. ' . $arFaker->firstName() . ' ' . $arFaker->lastName();
                $doctor->save();
            }
        }
    }
}
