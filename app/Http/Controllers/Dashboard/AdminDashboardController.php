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
        $startOfWeek = now()->startOfWeek();

        $metrics = [
            'registeredPatients' => Patient::count(),
            'newPatientsThisWeek' => Patient::where('created_at', '>=', $startOfWeek)->count(),
            'activeDoctors' => Doctor::where('status', 1)->count(),
            'totalDoctors' => Doctor::count(),
            'pendingAppointmentsToday' => Appointment::whereDate('appointment', today())
                ->where('type', 'غير مؤكد')
                ->count(),
            'invoicedToday' => Invoice::whereDate('invoice_date', today())->sum('total_with_tax'),
            'invoicedThisWeek' => Invoice::where('invoice_date', '>=', $startOfWeek)->sum('total_with_tax'),
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
                'label' => 'laboratory',
                'count' => $labPending,
                'percent' => $openWorkload > 0 ? round($labPending / $openWorkload * 100) : 0,
            ],
            [
                'label' => 'radiology',
                'count' => $rayPending,
                'percent' => $openWorkload > 0 ? round($rayPending / $openWorkload * 100) : 0,
            ],
            [
                'label' => 'ambulance_available',
                'count' => $ambulanceAvailable,
                'percent' => $ambulanceTotal > 0 ? round($ambulanceAvailable / $ambulanceTotal * 100) : 0,
            ],
        ];

        $rangeStart = today()->subDays(6);
        $dailyCounts = Appointment::whereBetween('appointment', [$rangeStart->copy()->startOfDay(), today()->endOfDay()])
            ->selectRaw('DATE(appointment) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd');

        $appointmentsTrend = collect(range(6, 0))->map(function ($daysAgo) use ($dailyCounts) {
            $date = today()->subDays($daysAgo);
            return [
                'label' => $date->translatedFormat('D'),
                'count' => (int) ($dailyCounts[$date->format('Y-m-d')] ?? 0),
            ];
        })->values();

        $statusBreakdown = [
            'pending' => Appointment::where('type', 'غير مؤكد')->count(),
            'confirmed' => Appointment::where('type', 'مؤكد')->count(),
            'completed' => Appointment::where('type', 'منتهي')->count(),
        ];

        $topDoctors = Appointment::select('doctor_id')
            ->selectRaw('count(*) as appointments_count')
            ->whereNotNull('doctor_id')
            ->groupBy('doctor_id')
            ->orderByDesc('appointments_count')
            ->take(5)
            ->get()
            ->map(function ($row) {
                $doctor = Doctor::with('section')->find($row->doctor_id);

                return $doctor ? [
                    'name' => $doctor->name,
                    'section' => optional($doctor->section)->name ?? '—',
                    'count' => $row->appointments_count,
                ] : null;
            })
            ->filter()
            ->values();

        return view('Dashboard.Admin.dashboard', [
            'metrics' => $metrics,
            'recentAppointments' => $recentAppointments,
            'departmentLoad' => $departmentLoad,
            'appointmentsTrend' => $appointmentsTrend,
            'statusBreakdown' => $statusBreakdown,
            'topDoctors' => $topDoctors,
        ]);
    }
}
