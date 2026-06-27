<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorSlot;
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
        $slotOptions = DoctorSlot::fixedSlotOptions();

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

                $this->assignWeeklySchedule($doctor, $slotOptions);
            }
        }
    }

    /**
     * Give each doctor a realistic fixed weekly schedule: a handful of
     * working days, each with a contiguous block of slots (morning or
     * afternoon shift), matching how the admin form assigns slots per day.
     */
    private function assignWeeklySchedule(Doctor $doctor, array $slotOptions): void
    {
        $workDays = collect(DoctorSlot::DAYS)->shuffle()->take(fake()->numberBetween(3, 5));
        $slotCount = count($slotOptions);

        foreach ($workDays as $day) {
            $shiftLength = fake()->numberBetween(8, 12);
            $startIndex = fake()->numberBetween(0, max(0, $slotCount - $shiftLength));

            foreach (array_slice($slotOptions, $startIndex, $shiftLength) as $option) {
                $doctor->slots()->create([
                    'day_of_week' => $day,
                    'start_time' => $option['start'],
                    'end_time' => $option['end'],
                ]);
            }
        }
    }
}
