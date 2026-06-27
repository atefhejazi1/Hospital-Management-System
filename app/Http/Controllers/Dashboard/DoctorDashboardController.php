<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Auth::guard('doctor')->user();
        $startOfWeek = now()->startOfWeek();

        $metrics = [
            'appointmentsToday' => $doctor->appointments()->whereDate('appointment', today())->count(),
            'appointmentsThisWeek' => $doctor->appointments()->where('appointment', '>=', $startOfWeek)->count(),
            'reviewInvoices' => Invoice::where('doctor_id', $doctor->id)->where('invoice_status', 2)->count(),
            'completedInvoices' => Invoice::where('doctor_id', $doctor->id)->where('invoice_status', 3)->count(),
        ];

        $todaySchedule = $doctor->scheduleForDate(today()->toDateString());

        $rangeStart = today()->subDays(6);
        $dailyCounts = $doctor->appointments()
            ->whereBetween('appointment', [$rangeStart->copy()->startOfDay(), today()->endOfDay()])
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
            'pending' => $doctor->appointments()->where('type', 'غير مؤكد')->count(),
            'confirmed' => $doctor->appointments()->where('type', 'مؤكد')->count(),
            'completed' => $doctor->appointments()->where('type', 'منتهي')->count(),
        ];

        $recentPatients = $doctor->appointments()->latest('appointment')->take(6)->get();

        return view('Dashboard.Doctor.dashboard', [
            'doctor' => $doctor,
            'metrics' => $metrics,
            'todaySchedule' => $todaySchedule,
            'appointmentsTrend' => $appointmentsTrend,
            'statusBreakdown' => $statusBreakdown,
            'recentPatients' => $recentPatients,
        ]);
    }
}
