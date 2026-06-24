<?php

namespace Database\Seeders;

use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Seeder;

class LedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();

        // Standalone patient receipts (money coming in), mirroring ReceiptRepository::store().
        for ($i = 0; $i < 15; $i++) {
            $patient = $patients->random();
            $amount = fake()->randomElement([50, 75, 100, 150, 200, 250]);
            $date = fake()->dateTimeBetween('-60 days', 'now')->format('Y-m-d');

            $receiptAccount = new ReceiptAccount();
            $receiptAccount->date = $date;
            $receiptAccount->patient_id = $patient->id;
            $receiptAccount->amount = $amount;
            $receiptAccount->description = 'Receipt for outstanding balance settlement.';
            $receiptAccount->save();

            $fundAccount = new FundAccount();
            $fundAccount->date = $date;
            $fundAccount->receipt_id = $receiptAccount->id;
            $fundAccount->Debit = $amount;
            $fundAccount->credit = 0.00;
            $fundAccount->save();

            $patientAccount = new PatientAccount();
            $patientAccount->date = $date;
            $patientAccount->patient_id = $patient->id;
            $patientAccount->receipt_id = $receiptAccount->id;
            $patientAccount->Debit = 0.00;
            $patientAccount->credit = $amount;
            $patientAccount->save();
        }

        // Standalone refunds/expenses paid out to patients, mirroring PaymentRepository::store().
        for ($i = 0; $i < 15; $i++) {
            $patient = $patients->random();
            $amount = fake()->randomElement([20, 30, 50, 80, 100]);
            $date = fake()->dateTimeBetween('-60 days', 'now')->format('Y-m-d');

            $paymentAccount = new PaymentAccount();
            $paymentAccount->date = $date;
            $paymentAccount->patient_id = $patient->id;
            $paymentAccount->amount = $amount;
            $paymentAccount->description = 'Refund for overpaid invoice balance.';
            $paymentAccount->save();

            $fundAccount = new FundAccount();
            $fundAccount->date = $date;
            $fundAccount->Payment_id = $paymentAccount->id;
            $fundAccount->credit = $amount;
            $fundAccount->Debit = 0.00;
            $fundAccount->save();

            $patientAccount = new PatientAccount();
            $patientAccount->date = $date;
            $patientAccount->patient_id = $patient->id;
            $patientAccount->Payment_id = $paymentAccount->id;
            $patientAccount->Debit = $amount;
            $patientAccount->credit = 0.00;
            $patientAccount->save();
        }
    }
}
