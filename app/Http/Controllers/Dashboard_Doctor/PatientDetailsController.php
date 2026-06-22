<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use App\Models\Patient;
use App\Models\Ray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PatientDetailsController extends Controller
{
    public function index($id)
    {
        $patient = Patient::findOrFail($id);

        // Previously any authenticated doctor could view ANY patient's full
        // diagnostic/ray/lab history just by changing $id in the URL (IDOR).
        // PatientPolicy::view() only allows a doctor who has actually
        // treated this patient (i.e. has an invoice with them).
        Gate::authorize('view', $patient);

        $patient_records = Diagnostic::where('patient_id', $id)->get();
        $patient_rays = Ray::where('patient_id', $id)->get();
        $patient_Laboratories  = Laboratorie::where('patient_id', $id)->get();
        return view('Dashboard.doctor.invoices.patient_details', compact('patient_records', 'patient_rays', 'patient_Laboratories'));
    }
}
