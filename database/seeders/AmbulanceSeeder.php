<?php

namespace Database\Seeders;

use App\Models\Ambulance;
use Illuminate\Database\Seeder;

class AmbulanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arFaker = fake('ar_SA');

        for ($i = 1; $i <= 6; $i++) {
            $model = new Ambulance();
            $model->car_number = 'AMB-' . str_pad((string) $i, 3, '0', STR_PAD_LEFT);
            $model->car_model = fake()->randomElement(['Toyota Hiace', 'Mercedes Sprinter', 'Ford Transit', 'Nissan Urvan']);
            $model->car_year_made = (string) fake()->numberBetween(2015, 2024);
            $model->driver_license_number = fake()->numerify('DL-######');
            $model->driver_phone = fake()->numerify('05########');
            $model->is_available = fake()->boolean(75) ? 1 : 0;
            $model->car_type = fake()->numberBetween(1, 2);
            $model->save();

            $model->translateOrNew('en')->driver_name = fake()->firstName() . ' ' . fake()->lastName();
            $model->translateOrNew('en')->notes = 'Equipped with basic life support and oxygen supply.';
            $model->translateOrNew('ar')->driver_name = $arFaker->firstName() . ' ' . $arFaker->lastName();
            $model->translateOrNew('ar')->notes = 'مجهزة بأجهزة الدعم الأساسي للحياة وتوفير الأكسجين.';
            $model->save();
        }
    }
}
