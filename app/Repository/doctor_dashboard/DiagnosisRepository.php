<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function store($request)
    {
        $invoice = $this->authorizedInvoiceFor($request);

        DB::beginTransaction();

        try {
            $this->invoice_status($invoice->id, 3);
            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $invoice->id;
            $diagnosis->patient_id = $invoice->patient_id;
            $diagnosis->doctor_id = $invoice->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        return view('Dashboard.Doctor.invoices.patient_record', compact('patient_records'));
    }

    public function addReview($request)
    {
        $invoice = $this->authorizedInvoiceFor($request);

        DB::beginTransaction();
        try {
            $this->invoice_status($invoice->id, 2);
            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date = date('Y-m-d H:i:s');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $invoice->id;
            $diagnosis->patient_id = $invoice->patient_id;
            $diagnosis->doctor_id = $invoice->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Previously doctor_id/patient_id were taken straight from request input
     * and saved verbatim onto the Diagnostic — any authenticated doctor could
     * submit someone else's invoice/patient/doctor IDs and attribute a
     * diagnosis to a different doctor or patient (broken object-level
     * authorization). This re-derives both from the authenticated doctor
     * guard and an invoice that is verified to actually belong to them.
     */
    private function authorizedInvoiceFor($request): Invoice
    {
        Gate::authorize('create', Diagnostic::class);

        $doctorId = Auth::guard('doctor')->id();

        return Invoice::where('id', $request->invoice_id)
            ->where('doctor_id', $doctorId)
            ->firstOrFail();
    }

    public function invoice_status($invoice_id, $id_status)
    {
        $invoice_status = Invoice::findorFail($invoice_id);
        $invoice_status->update([
            'invoice_status' => $id_status
        ]);
    }
}
