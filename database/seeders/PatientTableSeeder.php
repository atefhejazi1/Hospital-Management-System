<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $arFaker = fake('ar_SA');

        // Demo patient used across the app's manual test docs.
        $this->createPatient([
            'email' => 'patient@gmail.com',
            'password' => '123456789',
            'date_birth' => '1988-12-01',
            'phone' => '123456789',
            'gender' => '1',
            'blood_group' => 'A+',
            'name_en' => 'Mohammed Alsayed',
            'address_en' => 'Gaza',
            'name_ar' => 'محمد السيد',
            'address_ar' => 'غزة',
        ]);

        for ($i = 0; $i < 24; $i++) {
            $gender = fake()->boolean() ? '1' : '2';
            $firstNameEn = $gender === '1' ? fake()->firstNameMale() : fake()->firstNameFemale();

            $this->createPatient([
                'email' => fake()->unique()->safeEmail(),
                'password' => 'password',
                'date_birth' => fake()->dateTimeBetween('-85 years', '-2 years')->format('Y-m-d'),
                'phone' => fake()->unique()->numerify('05########'),
                'gender' => $gender,
                'blood_group' => fake()->randomElement($bloodGroups),
                'name_en' => $firstNameEn . ' ' . fake()->lastName(),
                'address_en' => fake()->city(),
                'name_ar' => $arFaker->firstName() . ' ' . $arFaker->lastName(),
                'address_ar' => $arFaker->city(),
            ]);
        }
    }

    private function createPatient(array $data): Patient
    {
        $patient = new Patient();
        $patient->email = $data['email'];
        $patient->password = $data['password'];
        $patient->Date_Birth = $data['date_birth'];
        $patient->Phone = $data['phone'];
        $patient->Gender = $data['gender'];
        $patient->Blood_Group = $data['blood_group'];
        $patient->save();

        $patient->translateOrNew('en')->name = $data['name_en'];
        $patient->translateOrNew('en')->Address = $data['address_en'];
        $patient->translateOrNew('ar')->name = $data['name_ar'];
        $patient->translateOrNew('ar')->Address = $data['address_ar'];
        $patient->save();

        return $patient;
    }
}
