<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            SectionSeeder::class,
            DoctorSeeder::class,
            PatientTableSeeder::class,
            RayEmployeeTableSeeder::class,
            LaboratorieEmployeeSeeder::class,
            ServiceTableSeeder::class,
            GroupSeeder::class,
            InsuranceSeeder::class,
            AmbulanceSeeder::class,
            AppointmentSeeder::class,
            InvoiceSeeder::class,
            LedgerSeeder::class,
            ChatSeeder::class,
        ]);
    }
}
