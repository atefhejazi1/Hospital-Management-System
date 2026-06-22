<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Patient;
use App\Models\Ray;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'registeredPatients' => Patient::count(),
            'activeDoctors' => Doctor::where('status', 1)->count(),
            'totalDoctors' => Doctor::count(),
            'pendingAppointmentsToday' => Appointment::whereDate('appointment', today())
                ->where('type', 'غير مؤكد')
                ->count(),
            'invoicedToday' => Invoice::whereDate('invoice_date', today())->sum('total_with_tax'),
        ];

        $recentAppointments = Appointment::with(['doctor', 'section'])
            ->latest('appointment')
            ->take(8)
            ->get();

        $labPending = Laboratorie::where('case', 0)->count();
        $rayPending = Ray::where('case', 0)->count();
        $ambulanceTotal = Ambulance::count();
        $ambulanceAvailable = Ambulance::where('is_available', 1)->count();

        $openWorkload = $labPending + $rayPending;

        $departmentLoad = [
            [
                'label' => 'Laboratory',
                'count' => $labPending,
                'percent' => $openWorkload > 0 ? round($labPending / $openWorkload * 100) : 0,
            ],
            [
                'label' => 'Radiology',
                'count' => $rayPending,
                'percent' => $openWorkload > 0 ? round($rayPending / $openWorkload * 100) : 0,
            ],
            [
                'label' => 'Ambulance Fleet Available',
                'count' => $ambulanceAvailable,
                'percent' => $ambulanceTotal > 0 ? round($ambulanceAvailable / $ambulanceTotal * 100) : 0,
            ],
        ];

        return view('Dashboard.Admin.dashboard', [
            'metrics' => $metrics,
            'recentAppointments' => $recentAppointments,
            'departmentLoad' => $departmentLoad,
        ]);
    }
}
