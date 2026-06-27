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
    public function index()
    {
        $patient = Auth::guard('patient')->user();

        $metrics = [
            'totalInvoices' => Invoice::where('patient_id', $patient->id)->count(),
            'reviewInvoices' => Invoice::where('patient_id', $patient->id)->where('invoice_status', 2)->count(),
            'completedInvoices' => Invoice::where('patient_id', $patient->id)->where('invoice_status', 3)->count(),
            'totalPaid' => ReceiptAccount::where('patient_id', $patient->id)->sum('amount'),
        ];

        $rangeStart = today()->subDays(6);
        $dailyCounts = Invoice::where('patient_id', $patient->id)
            ->whereBetween('invoice_date', [$rangeStart->copy()->startOfDay(), today()->endOfDay()])
            ->selectRaw('DATE(invoice_date) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $invoiceTrend = collect(range(6, 0))->map(function ($daysAgo) use ($dailyCounts) {
            $date = today()->subDays($daysAgo);
            return [
                'label' => $date->translatedFormat('D'),
                'count' => (int) ($dailyCounts[$date->format('Y-m-d')] ?? 0),
            ];
        })->values();

        $statusBreakdown = [
            'in_progress' => Invoice::where('patient_id', $patient->id)->where('invoice_status', 1)->count(),
            'review' => $metrics['reviewInvoices'],
            'completed' => $metrics['completedInvoices'],
        ];

        $recentInvoices = Invoice::with('Doctor')->where('patient_id', $patient->id)->latest('invoice_date')->take(6)->get();
        $recentLabs = Laboratorie::where('patient_id', $patient->id)->latest()->take(5)->get();
        $recentRays = Ray::where('patient_id', $patient->id)->latest()->take(5)->get();

        return view('Dashboard.dashboard_patient.dashboard', [
            'patient' => $patient,
            'metrics' => $metrics,
            'invoiceTrend' => $invoiceTrend,
            'statusBreakdown' => $statusBreakdown,
            'recentInvoices' => $recentInvoices,
            'recentLabs' => $recentLabs,
            'recentRays' => $recentRays,
        ]);
    }

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
