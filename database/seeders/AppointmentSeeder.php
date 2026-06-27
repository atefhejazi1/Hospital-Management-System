<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::with('slots')->get()->filter(fn (Doctor $doctor) => $doctor->slots->isNotEmpty());
        $types = ['غير مؤكد', 'مؤكد', 'منتهي'];
        $arFaker = fake('ar_SA');

        $booked = [];
        $created = 0;
        $attempts = 0;

        while ($created < 60 && $attempts < 600) {
            $attempts++;

            $doctor = $doctors->random();
            $slot = $doctor->slots->random();
            $type = fake()->randomElement([$types[0], $types[0], $types[1], $types[1], $types[2]]);

            // Past appointments are either confirmed (attended) or finished;
            // future appointments are unconfirmed or confirmed (not finished yet).
            $date = $type === $types[2]
                ? $this->randomDateForDay($slot->day_of_week, now()->subDays(30), now()->subDay())
                : $this->randomDateForDay($slot->day_of_week, now(), now()->addDays(20));

            if (!$date) {
                continue;
            }

            $key = $doctor->id . '|' . $date->format('Y-m-d') . '|' . $slot->start_time;

            if (isset($booked[$key])) {
                continue;
            }

            $booked[$key] = true;
            $created++;

            Appointment::create([
                'name' => $arFaker->firstName() . ' ' . $arFaker->lastName(),
                'email' => fake()->safeEmail(),
                'phone' => fake()->numerify('05########'),
                'notes' => fake()->boolean(40) ? fake()->sentence() : null,
                'doctor_id' => $doctor->id,
                'section_id' => $doctor->section_id,
                'type' => $type,
                'appointment' => $date->format('Y-m-d') . ' ' . $slot->start_time,
            ]);
        }
    }

    /**
     * A random date within [$start, $end] that falls on $dayOfWeek
     * (Carbon's English ->format('l') name, matching doctor_slots).
     */
    private function randomDateForDay(string $dayOfWeek, Carbon $start, Carbon $end): ?Carbon
    {
        $candidates = collect(CarbonPeriod::create($start, $end))
            ->filter(fn (Carbon $date) => $date->format('l') === $dayOfWeek);

        return $candidates->isNotEmpty() ? $candidates->random() : null;
    }
}
