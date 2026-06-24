<?php

namespace Database\Seeders;

use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Group;
use App\Models\Image;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\LaboratorieEmployee;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Ray;
use App\Models\RayEmployee;
use App\Models\Service;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    private array $diagnosisPairs = [
        ['diagnosis' => 'Acute upper respiratory tract infection.', 'medicine' => 'Amoxicillin 500mg three times daily for 7 days, paracetamol as needed.'],
        ['diagnosis' => 'Type 2 diabetes mellitus, moderately controlled.', 'medicine' => 'Metformin 850mg twice daily, dietary counseling advised.'],
        ['diagnosis' => 'Essential hypertension.', 'medicine' => 'Amlodipine 5mg once daily, low-sodium diet recommended.'],
        ['diagnosis' => 'Migraine without aura.', 'medicine' => 'Sumatriptan 50mg as needed, avoid known triggers.'],
        ['diagnosis' => 'Mild iron-deficiency anemia.', 'medicine' => 'Ferrous sulfate 325mg once daily with vitamin C.'],
        ['diagnosis' => 'Seasonal allergic rhinitis.', 'medicine' => 'Cetirizine 10mg once daily as needed.'],
        ['diagnosis' => 'Lower back strain.', 'medicine' => 'Ibuprofen 400mg twice daily, physiotherapy referral.'],
        ['diagnosis' => 'Gastroesophageal reflux disease.', 'medicine' => 'Omeprazole 20mg once daily before breakfast.'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $services = Service::all();
        $groups = Group::all();
        $rayEmployees = RayEmployee::all();
        $labEmployees = LaboratorieEmployee::all();

        $rayImages = ['pexels-pixabay-36762.jpg', 'pexels-souvenirpixels-414612.jpg', 'pexels-thanh-luu-29104820-30626449.jpg'];
        $labImages = ['pexels-cottonbro-8721318.jpg', 'pexels-frank-cone-140140-31190087.jpg', 'pexels-pixabay-36762.jpg'];

        for ($i = 0; $i < 70; $i++) {
            $patient = $patients->random();
            $doctor = $doctors->random();
            $invoiceType = fake()->boolean(65) ? 1 : 2; // 1 = single service, 2 = group
            $paymentType = fake()->boolean(60) ? 1 : 2; // 1 = cash, 2 = credit
            $invoiceStatus = fake()->randomElement([1, 1, 2, 3, 3]); // under treatment / review / completed
            $invoiceDate = fake()->dateTimeBetween('-60 days', 'now');

            $invoice = new Invoice();
            $invoice->invoice_type = $invoiceType;
            $invoice->invoice_date = $invoiceDate->format('Y-m-d');
            $invoice->patient_id = $patient->id;
            $invoice->doctor_id = $doctor->id;
            $invoice->section_id = $doctor->section_id;

            if ($invoiceType === 1) {
                $service = $services->random();
                $invoice->Service_id = $service->id;
                $invoice->price = $service->price;
                $invoice->discount_value = fake()->boolean(25) ? round($service->price * 0.1, 2) : 0;
                $taxRate = '17';
            } else {
                $group = $groups->random();
                $invoice->Group_id = $group->id;
                $invoice->price = $group->Total_before_discount;
                $invoice->discount_value = $group->discount_value;
                $taxRate = $group->tax_rate;
            }

            $taxValue = round(($invoice->price - $invoice->discount_value) * ((float) $taxRate / 100), 2);
            $invoice->tax_rate = $taxRate;
            $invoice->tax_value = $taxValue;
            $invoice->total_with_tax = round($invoice->price - $invoice->discount_value + $taxValue, 2);
            $invoice->type = $paymentType;
            $invoice->invoice_status = $invoiceStatus;
            $invoice->save();

            if ($paymentType === 1) {
                $fundAccount = new FundAccount();
                $fundAccount->date = $invoice->invoice_date;
                $fundAccount->invoice_id = $invoice->id;
                $fundAccount->Debit = $invoice->total_with_tax;
                $fundAccount->credit = 0.00;
                $fundAccount->save();
            } else {
                $patientAccount = new PatientAccount();
                $patientAccount->date = $invoice->invoice_date;
                $patientAccount->invoice_id = $invoice->id;
                $patientAccount->patient_id = $invoice->patient_id;
                $patientAccount->Debit = $invoice->total_with_tax;
                $patientAccount->credit = 0.00;
                $patientAccount->save();
            }

            // Real app only fires a notification + invoice-created event for cash, single-service invoices.
            if ($invoiceType === 1 && $paymentType === 1) {
                $notification = new Notification();
                $notification->user_id = $doctor->id;
                $notification->message = 'كشف جديد : ' . $patient->name;
                $notification->reader_status = fake()->boolean(50);
                $notification->save();
            }

            if ($invoiceStatus === 3) {
                $this->addDiagnostic($invoice, $invoiceDate);
            } elseif ($invoiceStatus === 2) {
                $this->addDiagnostic($invoice, $invoiceDate);
                $this->addDiagnosticReview($invoice, $invoiceDate);
            }

            if (fake()->boolean(25)) {
                $this->addRay($invoice, $rayEmployees, $rayImages);
            }

            if (fake()->boolean(25)) {
                $this->addLaboratorie($invoice, $labEmployees, $labImages);
            }
        }
    }

    private function addDiagnostic(Invoice $invoice, \DateTime $invoiceDate): void
    {
        $pair = fake()->randomElement($this->diagnosisPairs);

        $diagnostic = new Diagnostic();
        $diagnostic->date = $invoiceDate->format('Y-m-d');
        $diagnostic->diagnosis = $pair['diagnosis'];
        $diagnostic->medicine = $pair['medicine'];
        $diagnostic->invoice_id = $invoice->id;
        $diagnostic->patient_id = $invoice->patient_id;
        $diagnostic->doctor_id = $invoice->doctor_id;
        $diagnostic->save();
    }

    private function addDiagnosticReview(Invoice $invoice, \DateTime $invoiceDate): void
    {
        $pair = fake()->randomElement($this->diagnosisPairs);
        $reviewDate = (clone $invoiceDate)->modify('+' . fake()->numberBetween(2, 10) . ' days');

        $diagnostic = new Diagnostic();
        $diagnostic->date = $invoiceDate->format('Y-m-d');
        $diagnostic->review_date = $reviewDate->format('Y-m-d H:i:s');
        $diagnostic->diagnosis = $pair['diagnosis'];
        $diagnostic->medicine = $pair['medicine'];
        $diagnostic->invoice_id = $invoice->id;
        $diagnostic->patient_id = $invoice->patient_id;
        $diagnostic->doctor_id = $invoice->doctor_id;
        $diagnostic->save();
    }

    private function addRay(Invoice $invoice, $rayEmployees, array $rayImages): void
    {
        $completed = fake()->boolean(50);

        $ray = Ray::create([
            'description' => 'Chest X-ray requested to rule out underlying pulmonary pathology.',
            'invoice_id' => $invoice->id,
            'patient_id' => $invoice->patient_id,
            'doctor_id' => $invoice->doctor_id,
            'employee_id' => $completed ? $rayEmployees->random()->id : null,
            'description_employee' => $completed ? 'No acute abnormality detected. Lung fields are clear.' : null,
            'case' => $completed ? 1 : 0,
        ]);

        if ($completed) {
            $image = new Image();
            $image->filename = fake()->randomElement($rayImages);
            $image->imageable_id = $ray->id;
            $image->imageable_type = Ray::class;
            $image->save();
        }
    }

    private function addLaboratorie(Invoice $invoice, $labEmployees, array $labImages): void
    {
        $completed = fake()->boolean(50);

        $laboratorie = Laboratorie::create([
            'description' => 'Complete blood count and liver function panel requested.',
            'invoice_id' => $invoice->id,
            'patient_id' => $invoice->patient_id,
            'doctor_id' => $invoice->doctor_id,
            'employee_id' => $completed ? $labEmployees->random()->id : null,
            'description_employee' => $completed ? 'All values within normal reference ranges.' : null,
            'case' => $completed ? 1 : 0,
        ]);

        if ($completed) {
            $image = new Image();
            $image->filename = fake()->randomElement($labImages);
            $image->imageable_id = $laboratorie->id;
            $image->imageable_type = Laboratorie::class;
            $image->save();
        }
    }
}
