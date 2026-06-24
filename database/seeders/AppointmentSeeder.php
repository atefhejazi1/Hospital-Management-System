<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $types = ['غير مؤكد', 'مؤكد', 'منتهي'];
        $arFaker = fake('ar_SA');

        for ($i = 0; $i < 60; $i++) {
            $doctor = $doctors->random();
            $type = fake()->randomElement([$types[0], $types[0], $types[1], $types[1], $types[2]]);

            // Past appointments are either confirmed (attended) or finished;
            // future appointments are unconfirmed or confirmed (not finished yet).
            $appointmentDate = $type === $types[0]
                ? fake()->dateTimeBetween('now', '+20 days')
                : ($type === $types[2]
                    ? fake()->dateTimeBetween('-30 days', '-1 days')
                    : fake()->dateTimeBetween('-10 days', '+20 days'));

            Appointment::create([
                'name' => $arFaker->firstName() . ' ' . $arFaker->lastName(),
                'email' => fake()->safeEmail(),
                'phone' => fake()->numerify('05########'),
                'notes' => fake()->boolean(40) ? fake()->sentence() : null,
                'doctor_id' => $doctor->id,
                'section_id' => $doctor->section_id,
                'type' => $type,
                'appointment' => $appointmentDate,
            ]);
        }
    }
}
