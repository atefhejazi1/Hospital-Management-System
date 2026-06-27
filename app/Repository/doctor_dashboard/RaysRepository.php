<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\RaysRepositoryInterface;
use App\Models\Invoice;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class RaysRepository implements RaysRepositoryInterface
{

    public function store($request)
    {
        try {
            $invoice = Invoice::where('id', $request->invoice_id)
                ->where('doctor_id', Auth::guard('doctor')->id())
                ->firstOrFail();

            Ray::create([
                'description' => $request->description,
                'invoice_id' => $invoice->id,
                'patient_id' => $invoice->patient_id,
                'doctor_id' => $invoice->doctor_id,
            ]);
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $Ray = Ray::where('id', $id)
                ->where('doctor_id', Auth::guard('doctor')->id())
                ->firstOrFail();
            $Ray->update([
                'description' => $request->description,
            ]);
            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Ray::where('id', $id)
                ->where('doctor_id', Auth::guard('doctor')->id())
                ->firstOrFail()
                ->delete();
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
