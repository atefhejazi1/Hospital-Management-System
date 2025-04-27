<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function invoices()
    {

        $invoices = Invoice::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.dashboard_patient.invoices', compact('invoices'));
    }

    public function laboratories()
    {

        $laboratories = Laboratorie::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.dashboard_patient.laboratories', compact('laboratories'));
    }

    public function viewLaboratories($id)
    {

        $laboratorie = Laboratorie::findorFail($id);
        if ($laboratorie->patient_id != Auth::user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_patient.show_laboratories', compact('laboratorie'));
    }

    public function rays()
    {

        $rays = Ray::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.dashboard_patient.rays', compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if ($rays->patient_id != Auth::user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.dashboard_patient.show_rays', compact('rays'));
    }

    public function payments()
    {

        $payments = ReceiptAccount::where('patient_id', Auth::user()->id)->get();
        return view('Dashboard.dashboard_patient.payments', compact('payments'));
    }
}
