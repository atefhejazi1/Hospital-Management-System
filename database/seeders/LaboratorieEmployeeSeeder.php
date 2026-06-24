<?php

namespace Database\Seeders;

use App\Models\LaboratorieEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaboratorieEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arFaker = fake('ar_SA');

        LaboratorieEmployee::create([
            'name' => 'سارة أحمد',
            'email' => 'lab@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        for ($i = 0; $i < 4; $i++) {
            LaboratorieEmployee::create([
                'name' => $arFaker->firstName() . ' ' . $arFaker->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('123456789'),
            ]);
        }
    }
}
